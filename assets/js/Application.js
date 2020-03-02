let Application = function () {
    this.routing;
    this.objects = [];

    this.setRouting = function (routing) {
        this.routing = routing;
    };

    this.getRouting = function () {
        return this.routing;
    };

    this.getRouting = function () {
        return this.routing;
    };

    this.showSpinner = function () {
        $('div#spinner').show();
    };

    this.hideSpinner = function () {
        $('div#spinner').hide();
    };
};
export default Application;