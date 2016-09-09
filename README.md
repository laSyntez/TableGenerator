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
	use TableGenerator\HTMLTableGenerator\Structure\Row;
	use TableGenerator\HTMLTableGenerator\Structure\Cell;
	use TableGenerator\HTMLTableGenerator\Structure\TDCell;
	use TableGenerator\HTMLTableGenerator\Structure\THCell;
    use TableGenerator\HTMLTableGenerator\Attributes\AttributesHandler;
	use TableGenerator\Storage\SplStorage;
	use TableGenerator\Storage\ArrayStorage;

    /** Instantiate the table */
	$table = new Table(new ArrayStorage, new AttributesHandler(array('id' => 'planets')));

    /** Create the rows with the cells */
	$tr = new Row(new SplStorage);

    /** Create a th cell with a colspan value of 3 */
    $th = new THCell('Planets', 3);
	$tr->addCell($th);

	$tr2 = new Row(new ArrayStorage);
	$tr2->addCell(new TDCell('Mars', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED))
	    ->addCell(new TDCell('Jupiter', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED))
	    ->addCell(new TDCell('Pluton', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED))
    ;

	$tr3 = new Row(new SplStorage, new AttributesHandler(array('id' => 'mars')));
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

### Child elements storage
The table elements supposed to contain other table elements (Table and Row) have to set the type of storage (ArrayStorage or SplStorage) which implements the StorageInterface in order to handle the child elements.

```php
<?php
$table = new Table(new ArrayStorage);
/** OR */
$table = new Table(new SplStorage);
```

### AttributesHandler
Its role is to handle the HTML attributes of the table elements. It allows
to add HTML attributes to a table, row or cell.
The supported ones for now are : id, class and style.

```php
<?php
/** To add an id to a table */

/** VIA THE CONSTRUCTOR */
/** Create an instance of AttributesHandler by providing an array containing the attributes with their values  */
$handler = new AttributesHandler(array('id' => 'planets'));
/** Then pass it as the second parameter in The Table's Constructor */
$table = new Table(new SplStorage, $handler);

/** OR VIA THE setAttributesHandler METHOD */
$table = new Table(new SplStorage);
$table->setAttributesHandler($handler);
```

### License

MIT License. See the [file](./LICENSE.md)
