<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$testinngs = new StoutLogic\AcfBuilder\FieldsBuilder('testinngs', ['style' => 'seamless']);

$testinngs
    ->addRepeater('items')
        ->addText('item')
    ->endRepeater()
    ->setLocation('block', '==', 'acf/testinngs');

return acf_add_local_field_group($testinngs->build());