# Create ACF Blocks and Fields from the command line!
---

To get started, navigate to `wp-content/plugins/create-acf` and run `composer install`.

## Creating Fields

Run `wp create-acf field YourFieldName` to add a new field to the `/fields` directory.

## Creating Blocks

Run `wp create-acf block YourBlockName` to add a new block to the `/blocks` directory.

-- **Optional flags for creating a block**

```--nofield```
By default, an associated field is created in the `/fields` directory for your block.  If this is undesired, use the `--nofield` flag.

```--js```
Adds a js file to /`assets/scripts` directory and enqueues it in the `/blocks/register-your-block-name.php` file.

```--css```
Adds a css file to /`assets/styles` directory and enqueues it in the `/blocks/register-your-block-name.php` file.