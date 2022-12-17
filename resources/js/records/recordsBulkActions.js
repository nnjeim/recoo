/* eslint-disable no-undef */
/* eslint-disable camelcase */
export default () => ({
  action: '',
  showApplyButton: false,
  initState() {
    this.action = '';
    this.showApplyButton = false;
  },
  toast(message) {
    window.dispatchEvent(new CustomEvent('toast-ev', {
      detail: {
        message,
        type: 'warning',
        title: 'Warning!',
      },
    }));
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
