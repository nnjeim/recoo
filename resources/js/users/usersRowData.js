/* eslint-disable import/no-unresolved */
/* eslint-disable arrow-body-style */
import emitter from '../lib/emitter';

export default (row) => {
  return {
    row: {},
    disabled: true,
    visible: false,
    init() {
      this.row = row;
      emitter.on('setRecord-ev', (id) => {
        if (this.row.id !== id) {
          this.disabled = true;
        }
      });
      /* selected Records event */
      window.addEventListener('selectedRecords-ev', (event) => {
        const selectedRecords = event.detail.data;
        this.row.selected = selectedRecords.indexOf(this.row.id) >= 0;
      });
    },
    toggleSelect() {
      this.$wire.emitUp('toggleSelect-ev', this.row.id);
    },
  };
};
