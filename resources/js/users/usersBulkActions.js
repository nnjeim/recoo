/* eslint-disable no-undef */
/* eslint-disable camelcase */
export default () => ({
  action: '',
  showApplyButton: false,
  initState() {
    this.action = '';
    this.showApplyButton = false;
  },
  onChange() {
    this.showApplyButton = false;
    if (this.action) {
      this.showApplyButton = true;
    }
  },
  callAction() {
    this.$wire.emit(this.action);
    this.initState();
  },
});
