document.addEventListener('alpine:init', () => {
    Alpine.magic('_data', (el) => {
        if (el.tagName == "SELECT") {
            return attr => el.options[el.selectedIndex].getAttribute(`data-${attr}`);
        } else {
            return attr => el.getAttribute(`data-${attr}`);
        }
		
	});
    
    Alpine.directive('onselect2', (el,{ modifiers } ) => {
		
		$(el).on('select2:select',(e) => {
			let eventName = 'change';
			el.dispatchEvent(new CustomEvent(eventName,{ detail: e.target.value, bubbles: true }));
			if (modifiers.length > 0) {
				eventName = modifiers[0];
				el.dispatchEvent(new CustomEvent(eventName,{ detail: e.target.value, bubbles: true }));
			}
		})
	});
    
    
});