var Base = function () {

};

Base.prototype = {
	alert: function () {
		alert(111);
	},
	url: null,
	params: {},
	method: 'post',

	setUrl: function (url) {
		this.url = url;
		return this;
	},
	getUrl: function () {
		return this.url;
	},
	setMethod: function (method) {
		this.method = method;
		return this;
	},
	getMethod: function () {
		return this.method;
	},
	resetParams: function () {
		this.params = {};
		return this;
	},
	setParams: function (params) {
		this.params = params;
		return this;
	},
	getParams: function (key) {
		if (typeof key == 'undefined') {
			return this.params;
		}
		if (typeof this.params[key] != 'undefined') {
			return null;
		}
		return this.params[key];
	},
	addParams: function (key, value) {
		this.params[key] = value;
		return this;
	},
	removeParams: function (key) {
		if (typeof this.params[key] != 'undefined') {
			delete this.params[key];
			return this;
		}
	},
	load: function () {
		var request = $.ajax({
			url: this.getUrl(),
			method: this.getMethod(),
			data: this.getParams(),

			success: function (responce) {
				alert("hi");
			}

		})

	}
};

var object = new Base();
object.setParams({
	name: 'hello',
	email: 'hello@world.com'

});
object.setUrl('http://http://localhost:9080/QuesteCom/index.php?c=product&a=test');
object.load();