This facet type is a combination of multiple facet queries into a single facet, not a standard Solr facet type. It was added because it is quite common to present multiple query counts as a single facet. In that case this multiquery facet is much easier to work with than multiple separate facet queries.

Internally this facet uses multiple instances of the [Facet query](V3:Facet_query "wikilink") class. You can use the 'createQuery' method to add new facet queries.

You can also manage the excludes for a multiquery facet by calling 'addExclude', 'removeExclude' and 'clearExcludes'. Changes to excludes will be forwarded to all facet queries.

See the API docs for all available methods.

Example
-------

```php
<?php

require(__DIR__.'/init.php');
htmlHeader();

// ...

// create a client instance
$client = new Solarium\Client($adapter, $eventDispatcher, $config);

// get a select query instance
$query = $client->createSelect();

// get the facetset component
$facetSet = $query->getFacetSet();

// create a facet query instance and set options
$facet = $facetSet->createFacetMultiQuery('stock');
$facet->createQuery('stock_pricecat1', 'inStock:true AND price:[1 TO 300]');
$facet->createQuery('nostock_pricecat1', 'inStock:false AND price:[1 TO 300]');
$facet->createQuery('stock_pricecat2', 'inStock:true AND price:[300 TO *]');
$facet->createQuery('nostock_pricecat2', 'inStock:false AND price:[300 TO *]');

// this executes the query and returns the result
$resultset = $client->select($query);

// display the total number of documents found by solr
echo 'NumFound: '.$resultset->getNumFound();

// display facet counts
echo '<hr/>Multiquery facet counts:<br/>';
$facet = $resultset->getFacetSet()->getFacet('stock');
foreach ($facet as $key => $count) {
    echo $key . ' [' . $count . ']<br/>';
}

// show documents using the resultset iterator
foreach ($resultset as $document) {

    echo '<hr/><table>';
    echo '<tr><th>id</th><td>' . $document->id . '</td></tr>';
    echo '<tr><th>name</th><td>' . $document->name . '</td></tr>';
    echo '<tr><th>price</th><td>' . $document->price . '</td></tr>';
    echo '</table>';
}

htmlFooter();

```
