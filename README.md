# TableGenerator [![Build Status](https://travis-ci.org/laSyntez/TableGenerator.svg?branch=master)](https://travis-ci.org/laSyntez/TableGenerator)

Object Oriented PHP library to generate HTML tables

### Requirements

 * PHP 5.5+

### Installation

```cli
 $ composer require lasyntez/table-generator
```

### Basic usage

Front end developers should know that creating tables can be tricky sometimes. This library provides an elegant and intuitive way to ease their generation either statically or dynamically.

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

    /** Create a th cell with a colspan value of 3 and add it to the first row */
    $th = new THCell('Planets', 3);
	$tr->addCell($th);

	$tr2 = new Row(new ArrayStorage);
	$tr2->addCell(new TDCell('Jupiter', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED))
      ->addCell(new TDCell('Mars', Cell::COLSPAN_REGULAR, Cell::ROWSPAN_REGULAR))
      ->addCell(new TDCell('Pluton', 1, 1))
  ;

	$tr3 = new Row(new SplStorage, new AttributesHandler(array('id' => 'orion')));
	$tr3->addCells(array(
		new TDCell('Neptune', 1, 1, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED),
		new TDCell('Saturn', Cell::COLSPAN_REGULAR, Cell::ROWSPAN_REGULAR),
		new TDCell('Venus', 1, 1),
	));

	/** Add the rows to the table individually  */
	$table->addRow($tr)
		    ->addRow($tr2)
	      ->addRow($tr3)
  ;

	/** Or collectively  */
	$table->addRows(array($tr2, $tr, $tr3));

    /** Generate the html code */
	$html = $table->generate();

    /** And display it on the web page */
	echo $html;
```

### Child elements storage
The table elements (e.g. Table and Row) supposed to contain other ones have to set the type of storage (ArrayStorage or SplStorage) which implements the StorageInterface in order to handle the child elements. To be concrete, it allows to add rows to a table or cells to a row as well as their removal.

```php
<?php

$table = new Table(new ArrayStorage);

/** OR */

$table = new Table(new SplStorage);
```

### HTML attributes
The HTML attributes of the table elements are handled by AttributesHandler. Its role is to add HTML attributes to a table, row or cell and thus allows css and js interaction.
The supported ones are : id, class and style.

```php
<?php

/** To add an id to a table */

/** VIA THE CONSTRUCTOR */
/** Create an instance of AttributesHandler by providing an array containing the attributes with their values  */
$handler = new AttributesHandler(array('id' => 'planets'));
/** Then pass it as the second parameter in The Table's Constructor */
$table = new Table(new SplStorage, $handler);

/** OR VIA THE setAttributesHandler METHOD */
$table = new Table(new ArrayStorage);
$table->setAttributesHandler($handler);
```

### Cell creation

To create a cell either a THCell or a TDCell, the content is the first and only parameter required. The other ones (colspan, rowspan, width, height, and AttributesHandler) are optional.

```php
<?php

$td = new TDCell('<a href="planets/pluton.html">Pluton</a>');

/** TO SET A WIDTH OF 300px AND A HEIGHT OF 200px */
$td = new THCell('Pluton', Cell::COLSPAN_REGULAR, Cell::ROWSPAN_REGULAR, 300, 200);

/** TO SET A COLSPAN OF 3 AND A ROWSPAN OF 5 */
$td = new THCell('Pluton', 3, 5, 300, 200);

/** ADD A CLASS ATTRIBUTE BY PASSING AN INSTANCE OF AttributesHandler AS THE LAST PARAMETER IN THE CELL'S CONSTRUCTOR */
$td = new THCell('Pluton', Cell::COLSPAN_REGULAR, Cell::ROWSPAN_REGULAR, Cell::WIDTH_UNDEFINED, Cell::HEIGHT_UNDEFINED, new AttributesHandler(array('class' => 'pluton')));
```

### License

MIT License. See the [file](./LICENSE.md)
