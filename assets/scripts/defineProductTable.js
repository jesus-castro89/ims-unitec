import {table_search, table_pagination, table_label, configTable} from './table_definitions';
import {html} from "gridjs";

$(function () {

  configTable(['Nombre', 'Precio', 'Categoría', 'Acciones'],
    data => data.results.map(entity => [
      entity.name, entity.price, entity.category, html(entity.edit)
    ]));
});
