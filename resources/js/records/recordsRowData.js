/* eslint-disable import/no-unresolved */
/* eslint-disable arrow-body-style */
export default (row) => {
  return {
    row: {},
    init() {
      this.row = row;
    },
  };
};
