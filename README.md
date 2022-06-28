# Create ACF Blocks and Fields from the command line!
---

To get started, navigate to `wp-content/plugins/create-acf` and run `composer install`.

## Creating Fields

```wp create-acf field YourFieldName```bash

Adds a new field to the `/fields` directory.

## Creating Blocks

```wp create-acf block YourBlockName```bash

Adds a new block to the `/blocks` directory.

### Optional flags for creating a block

```--nofield```bash

By default, an associated field is created in the `/block/your-block-name` directory.  If this is undesired, use the `--nofield` flag.

```--js```bash

Adds a js file to the `/blocks/your-block-name` directory and enqueues it in the `/blocks/your-block-name/register-your-block-name.php` file.

```--css```bash

Adds a css file to the `/blocks/your-block-name` directory and enqueues it in the `/blocks/your-block-nameregister-your-block-name.php` file.