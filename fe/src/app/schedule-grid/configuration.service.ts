import { Injectable } from '@angular/core';
import { Config } from './config';

@Injectable()
export class ConfigService {
  public static config: Config = {
    searchEnabled: false,
    headerEnabled: true,
    orderEnabled: true,
    globalSearchEnabled: true,
    paginationEnabled: true,
    exportEnabled: true,
    clickEvent: true,
    selectRow: true,
    selectCol: false,
    selectCell: false,
    rows: 20,
    additionalActions: true,
    serverPagination: false,
    isLoading: false,
    detailsTemplate: false,
    groupRows: false,
    paginationRangeEnabled: false,
    collapseAllRows: false,
    checkboxes: false,
    resizeColumn: false,
    fixedColumnWidth: false,
    horizontalScroll: false,
    draggable: false,
    logger: false,
    showDetailsArrow: false,
    showContextMenu: false,
    persistState: false,
    tableLayout: {
      style: 'normal',
      theme: 'light',
      borderless: false,
      hover: true,
      striped: false,
    },
  };
}
