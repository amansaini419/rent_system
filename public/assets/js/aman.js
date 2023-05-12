'use strict';

const dateFormat = (date) => moment(date).format("DD-MMM-YY");

const currencyFormat = (amount, decimal) => parseFloat(amount).toFixed(decimal);