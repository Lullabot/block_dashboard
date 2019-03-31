# Block Dashboard

When using blocks in Layout Builder, there is no easy way to get an overview of what blocks are used where. This module creates a view at `/admin/content/blocks` that displays an overview of both reusable and nonreusable custom blocks. Features include:

- Block content and operations can be managed outside the block administration area, in the same place other content is managed.
- The view includes a button to add new blocks directly from the dashboard (which later can be referenced from Layout Builder).
- Operations links are provided only for reusable blocks since you can't edit content of inline blocks outside of Layout Builder.
- Each block description is appended with links to any page(s) where that block has been used in Layout Builder. This makes it easy to go see the block in context or edit it in Layout Builder.
- Reusable blocks can be edited from the dashboard, and the changes will affect all usages. But because of the links to where the block is used, you will be able to see what other pages will be affected by the changes.
- You can search through all blocks to find any that contain specific text to make it easy to update it in all places, or as a reminder of where that text is used.


## Configuration

- Navigate to admin > extend and enable the module.
- The module will install a pre-configured block view, which you can further edit.


## Composer 

To include this module in a composer project, add the following to the 'repositories' section of the top level composer.json file:

```
        "lullabot/block_dashboard": {
            "type": "vcs",
            "url": "https://github.com/lullabot/block_dashboard.git",
            "no-api": true
        }
```

Then type the following on the command line:

```
composer require lullabot/block_dashboard --prefer-source
```