# Create ACF Blocks and Fields from the command line!
<br />
<br />
To get started, navigate to `wp-content/plugins/create-acf` and run `composer install`.
<br />
<br />

## Creating Fields

```wp create-acf field YourFieldName```

Adds a new field to the `/fields` directory.
<br />
<br />

## Creating Blocks

```wp create-acf block YourBlockName```

Adds a new block to the `/blocks` directory.
<br />
<br />

### Optional flags for creating a block

- ```--nofield```

By default, an associated field is created in the `/block/your-block-name` directory.  If this is undesired, use the `--nofield` flag.
<br />
<br />

- ```--js```

Adds a js file to the `/blocks/your-block-name` directory and enqueues it in the `/blocks/your-block-name/register-your-block-name.php` file.
<br />
<br />

- ```--css```

Adds a css file to the `/blocks/your-block-name` directory and enqueues it in the `/blocks/your-block-nameregister-your-block-name.php` file.