'use strict';

const dateFormat = (date) => moment(date).format("DD-MMM-YY");

const currencyFormat = (amount, decimal = 2) => parseFloat(amount).toFixed(decimal);

const calculateMonthlyPayment = (loanAmount, monthlyInterest, totalInstallments) => {
  const adj = Math.pow((1 + monthlyInterest), totalInstallments);
  return (loanAmount * monthlyInterest * adj / (adj - 1));
}

const calculateSI = (principal, rate, time) => ( (principal * rate * time) / 100 );

const setCountryCodes = async() => await $.ajax('../../json/CountryCodes.json');

const showLoader = () => $('.theme-loader').fadeIn('slow');
const hideLoader = () => $('.theme-loader').fadeOut('slow');
