$(document).ready(function() {
    const meta = {
        'washing-machine': {
            title: 'Best Washing Machine Repair Service in {{area}} {{city}}',
            description: 'Get the best washing machine repair service near me in {{area}} {{city}} like Front Loading Washing Machines, Washer And Dryer Combo, Integrated, Stackable, Portable Or Compact, Top-Loading, Semi-Automatic, Fully-Automatic.'
        },
        'fridge': {
            title: 'Best Refrigerator Fridge Repair Service in {{area}} {{city}}',
            description: 'Get the best fridge and refrigerator service near me in {{area}} {{city}} like Single Door, Double Door, Triple Door, Side By Side, French Door, Top Freezer.'
        },
        'geyser': {
            title: '',
            description: ''
        },
        'ro': {
            title: '',
            description: ''
        }
    }

    function capitalCase(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }      

    const urlSearchParams = new URLSearchParams(window.location.search);
    const params = Object.fromEntries(urlSearchParams.entries());
    const { service, city, area } = params;
    /**
     * service,area,city
     */
    if (service == 'washing-machine') {
        document.title = (meta[service].title).replace('{{area}}', capitalCase(area)).replace('{{city}}', capitalCase(city));
        document.querySelector('meta[name="description"]').setAttribute("content", (meta[service].description).replace('{{area}}', capitalCase(area)).replace('{{city}}', capitalCase(city)));
    } else if (service == 'fridge') {

    }
});