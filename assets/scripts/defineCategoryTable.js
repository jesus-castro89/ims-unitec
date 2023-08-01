import {table_search, table_pagination, table_label, configTable} from './table_definitions';
import {html} from "gridjs";


$(function () {

    configTable(['Nombre', 'Acciones'], data => data.results.map(entity => [
        entity.name, html(entity.edit)
    ]));
});
