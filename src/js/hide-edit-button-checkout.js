document.addEventListener("DOMContentLoaded", function () {
  setAddressFieldsReadOnly();
});

const isBillingAddressReadOnly = () => {
  return true;
};

const isShippingAddressReadOnly = () => {
  return true;
};

const setAddressFieldsReadOnly = () => {
  const { registerCheckoutFilters } = window.wc.blocksCheckout;
  registerCheckoutFilters("woocommerce-readonly-addressfields", {
    isBillingAddressReadOnly: isBillingAddressReadOnly,
    isShippingAddressReadOnly: isShippingAddressReadOnly,
  });
};
