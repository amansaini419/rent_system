'use strict';

const dateFormat = (date) => moment(date).format("DD-MMM-YY");

const currencyFormat = (amount, decimal) => parseFloat(amount).toFixed(decimal);

const calculateMonthlyPayment = (loanAmount, monthlyInterest, totalInstallments) => {
  const adj = Math.pow((1 + monthlyInterest), totalInstallments);
  return (loanAmount * monthlyInterest * adj / (adj - 1));
}

const calculateSI = (principal, rate, time) => ( (principal * rate * time) / 100 );