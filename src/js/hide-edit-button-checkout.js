document.addEventListener("DOMContentLoaded", function () {
  setAddressFieldsReadOnly();
});

const isBillingAddressReadOnly = () => {
  return true;
};

const isShippingAddressReadOnly = () => {
  return true;
};
const setFixedShippingAddress = () => {
  console.log("setFixedBillingAddress called");
  return {
    first_name: "John",
    last_name: "Doe",
    company: "WooCommerce",
    country: "US",
    address_1: "123 Main St",
    address_2: "",
    city: "San Francisco",
    state: "CA",
    postcode: "94103",
  };
};

const setFixedBillingAddress = () => {
  console.log("setFixedBillingAddress called");
  return {
    first_name: "Test",
    last_name: "Billing",
    company: "WooCommerce Billing Co.",
    country: "US",
    address_1: "123 Main St Billing",
    address_2: "",
    city: "San Francisco",
    state: "CA",
    postcode: "94103",
  };
};
const setAddressFieldsReadOnly = () => {
  const { registerCheckoutFilters } = window.wc.blocksCheckout;
  registerCheckoutFilters("woocommerce-readonly-addressfields", {
    isBillingAddressReadOnly: isBillingAddressReadOnly,
    isShippingAddressReadOnly: isShippingAddressReadOnly,
    setFixedBillingAddress: setFixedBillingAddress,
    setFixedShippingAddress: setFixedShippingAddress,
  });
};
