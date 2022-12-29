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
    edit() {
      this.disabled = false;
      emitter.emit('setRecord-ev', this.row.id);
    },
    cancel() {
      this.disabled = true;
    },
    toggleSelect() {
      this.$wire.emitUp('toggleSelect-ev', this.row.id);
    },
    toggleStatus() {
      if (!this.disabled) {
        this.row.status = +this.row.status === 1 ? 0 : 1;
        this.$wire.set('rowData.status', this.row.status);
      }
    },
  };
};
