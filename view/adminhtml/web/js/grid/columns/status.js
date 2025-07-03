/**
 * ManiyaTech
 *
 * @author        Milan Maniya
 * @package       ManiyaTech_Core
 */

define(
    [
    'Magento_Ui/js/grid/columns/select'
    ], function (Column) {
        'use strict';

        return Column.extend(
            {
                defaults: {
                    bodyTmpl: 'ManiyaTech_Core/ui/grid/cells/status'
                },

                /**
                 * Get CSS class based on status value.
                 *
                 * @param   {Object} row
                 * @returns {String}
                 */
                getStatusColor: function (row) {
                    switch (row.status) {
                    case '1':
                        return 'status-enabled';
                    case '0':
                        return 'status-disabled';
                    default:
                        return 'status-unknown';
                    }
                }
            }
        );
    }
);
