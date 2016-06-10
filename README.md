# TableGenerator

[![DUB](https://img.shields.io/dub/l/vibe-d.svg)](./LICENSE.md)

Object Oriented PHP library to generate HTML tables

### Requirements

 * PHP 5.3+

### Installation

```cli
 $ composer require lasyntez/table-generator
```

### Basic usage

Front end developers should know that creating tables can be tricky sometimes. This library provides an elegant and intuitive way of generation

```php
<?php
	require_once('vendor/autoload.php');

	use TableGenerator\HTMLTableGenerator\Structure\Table;
	use TableGenerator\HTMLTableGenerator\Structure\TR;
	use TableGenerator\HTMLTableGenerator\Structure\Cell;
	use TableGenerator\HTMLTableGenerator\Structure\TDCell;
	use TableGenerator\HTMLTableGenerator\Structure\THCell;
    use TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler;
	use TableGenerator\Storage\SplStorage;
	use TableGenerator\Storage\ArrayStorage;

    /** Instantiate the table */
	$table = new Table(new ArrayStorage, new AttributesHandler(array('id' => 'planets')));

    /** Create the rows with the cells */
	$tr = new TR(new ArrayStorage);

    /** Create a th cell with a colspan value of 3 */
    $th = new THCell('Planets', 3);
	$tr->addCell($th);

	$tr2 = new TR(new ArrayStorage);
	$tr2->addCell(new TDCell('Mars', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED))
	    ->addCell(new TDCell('Jupiter', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED))
	    ->addCell(new TDCell('Pluton', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED))
    ;

	$tr3 = new TR(new SplStorage, new AttributesHandler(array('id' => 'mars')));
	$tr3->addCells(array(
		new TDCell('Neptune', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED),
		new TDCell('Saturn', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED),
		new TDCell('Venus', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED),
	));

	/** Add the rows to the table individualy  */
	$table->addRow($tr)
		  ->addRow($tr2)
		  ->addRow($tr3)
    ;

	/** Or add the rows to the table collectively  */
	$table->addRows(array($tr2, $tr, $tr3));

    /** Generate the html code */
	$html = $table->generate();

    /** Or display it on the web page */
	echo $html;
```

### License

MIT License. See the [file](./LICENSE.md)
