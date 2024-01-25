document.addEventListener("DOMContentLoaded", function () {
	var observer = new MutationObserver(function (mutations) {
		mutations.forEach(function (mutation) {
			if (mutation.addedNodes.length) {
				let editButton = document.querySelector(
					".wc-block-components-address-card__edit"
				);
				let useSameAddressForBilling = document.querySelector(
					".wc-block-checkout__use-address-for-billing"
				);
				let shippingTitle = document.querySelector(
					".wc-block-checkout__shipping-fields .wc-block-components-title"
				);

				if (shippingTitle && shippingTitle.textContent.includes("Shipping")) {
					shippingTitle.textContent = "Shipping And Billing Address";
				}
				if (editButton) {
					editButton.style.display = "none";
				}
				if (useSameAddressForBilling) {
					useSameAddressForBilling.style.display = "none";
				}
			}
		});
	});

	observer.observe(document.body, {
		childList: true,
		subtree: true,
	});
});
