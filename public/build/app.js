(self["webpackChunk"] = self["webpackChunk"] || []).push([["app"],{

/***/ "./assets/app.js":
/*!***********************!*\
  !*** ./assets/app.js ***!
  \***********************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _stimulus_bootstrap_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./stimulus_bootstrap.js */ "./assets/stimulus_bootstrap.js");
/* harmony import */ var _styles_app_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./styles/app.css */ "./assets/styles/app.css");

//import './bootstrap.js';
/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)


/***/ }),

/***/ "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$":
/*!****************************************************************************************************************!*\
  !*** ./assets/controllers/ sync ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \.[jt]sx?$ ***!
  \****************************************************************************************************************/
/***/ ((module, __unused_webpack_exports, __webpack_require__) => {

var map = {
	"./csrf_protection_controller.js": "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/csrf_protection_controller.js",
	"./hello_controller.js": "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js"
};


function webpackContext(req) {
	var id = webpackContextResolve(req);
	return __webpack_require__(id);
}
function webpackContextResolve(req) {
	if(!__webpack_require__.o(map, req)) {
		var e = new Error("Cannot find module '" + req + "'");
		e.code = 'MODULE_NOT_FOUND';
		throw e;
	}
	return map[req];
}
webpackContext.keys = function webpackContextKeys() {
	return Object.keys(map);
};
webpackContext.resolve = webpackContextResolve;
module.exports = webpackContext;
webpackContext.id = "./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$";

/***/ }),

/***/ "./assets/stimulus_bootstrap.js":
/*!**************************************!*\
  !*** ./assets/stimulus_bootstrap.js ***!
  \**************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   app: () => (/* binding */ app)
/* harmony export */ });
/* harmony import */ var _symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/stimulus-bridge */ "./node_modules/@symfony/stimulus-bridge/dist/index.js");


// Registers Stimulus controllers from controllers.json and in the controllers/ directory
var app = (0,_symfony_stimulus_bridge__WEBPACK_IMPORTED_MODULE_0__.startStimulusApp)(__webpack_require__("./assets/controllers sync recursive ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js! \\.[jt]sx?$"));
// register any custom, 3rd party controllers here
// app.register('some_controller_name', SomeImportedController);

/***/ }),

/***/ "./assets/styles/app.css":
/*!*******************************!*\
  !*** ./assets/styles/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json":
/*!************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/dist/webpack/loader.js!./assets/controllers.json ***!
  \************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
/* harmony import */ var _symfony_ux_autocomplete_dist_controller_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @symfony/ux-autocomplete/dist/controller.js */ "./vendor/symfony/ux-autocomplete/assets/dist/controller.js");
/* harmony import */ var tom_select_dist_css_tom_select_default_css__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! tom-select/dist/css/tom-select.default.css */ "./node_modules/tom-select/dist/css/tom-select.default.css");


/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = ({
  'symfony--ux-autocomplete--autocomplete': _symfony_ux_autocomplete_dist_controller_js__WEBPACK_IMPORTED_MODULE_0__["default"],
});

/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/csrf_protection_controller.js":
/*!****************************************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/csrf_protection_controller.js ***!
  \****************************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ controller)
/* harmony export */ });
/* harmony import */ var _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @hotwired/stimulus */ "./node_modules/@hotwired/stimulus/dist/stimulus.js");

const controller = class extends _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_0__.Controller {
    constructor(context) {
        super(context);
        this.__stimulusLazyController = true;
    }
    initialize() {
        if (this.application.controllers.find((controller) => {
            return controller.identifier === this.identifier && controller.__stimulusLazyController;
        })) {
            return;
        }
        Promise.all(/*! import() */[__webpack_require__.e("vendors-node_modules_core-js_modules_es_array-buffer_constructor_js-node_modules_core-js_modu-cebe39"), __webpack_require__.e("assets_controllers_csrf_protection_controller_js")]).then(__webpack_require__.bind(__webpack_require__, /*! ./assets/controllers/csrf_protection_controller.js */ "./assets/controllers/csrf_protection_controller.js")).then((controller) => {
            this.application.register(this.identifier, controller.default);
        });
    }
};


/***/ }),

/***/ "./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js":
/*!******************************************************************************************************************!*\
  !*** ./node_modules/@symfony/stimulus-bridge/lazy-controller-loader.js!./assets/controllers/hello_controller.js ***!
  \******************************************************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ _default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.symbol.to-primitive.js */ "./node_modules/core-js/modules/es.symbol.to-primitive.js");
/* harmony import */ var core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.error.cause.js */ "./node_modules/core-js/modules/es.error.cause.js");
/* harmony import */ var core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_4__);
/* harmony import */ var core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.error.to-string.js */ "./node_modules/core-js/modules/es.error.to-string.js");
/* harmony import */ var core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_5__);
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_6__);
/* harmony import */ var core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.date.to-primitive.js */ "./node_modules/core-js/modules/es.date.to-primitive.js");
/* harmony import */ var core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_7___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_7__);
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_8___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_8__);
/* harmony import */ var core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.number.constructor.js */ "./node_modules/core-js/modules/es.number.constructor.js");
/* harmony import */ var core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_9___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_9__);
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_10___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_10__);
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_11___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_11__);
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_12___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_12__);
/* harmony import */ var core_js_modules_es_object_proto_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! core-js/modules/es.object.proto.js */ "./node_modules/core-js/modules/es.object.proto.js");
/* harmony import */ var core_js_modules_es_object_proto_js__WEBPACK_IMPORTED_MODULE_13___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_proto_js__WEBPACK_IMPORTED_MODULE_13__);
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_14___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_14__);
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_15___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_15__);
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_16___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_16__);
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_17___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_17__);
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_18___default = /*#__PURE__*/__webpack_require__.n(core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_18__);
/* harmony import */ var _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! @hotwired/stimulus */ "./node_modules/@hotwired/stimulus/dist/stimulus.js");
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }



















function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }


/*
 * This is an example Stimulus controller!
 *
 * Any element with a data-controller="hello" attribute will cause
 * this controller to be executed. The name "hello" comes from the filename:
 * hello_controller.js -> "hello"
 *
 * Delete this file or adapt it for your use!
 */
var _default = /*#__PURE__*/function (_Controller) {
  function _default() {
    _classCallCheck(this, _default);
    return _callSuper(this, _default, arguments);
  }
  _inherits(_default, _Controller);
  return _createClass(_default, [{
    key: "connect",
    value: function connect() {
      this.element.textContent = 'Hello Stimulus! Edit me in assets/controllers/hello_controller.js';
    }
  }]);
}(_hotwired_stimulus__WEBPACK_IMPORTED_MODULE_19__.Controller);


/***/ }),

/***/ "./vendor/symfony/ux-autocomplete/assets/dist/controller.js":
/*!******************************************************************!*\
  !*** ./vendor/symfony/ux-autocomplete/assets/dist/controller.js ***!
  \******************************************************************/
/***/ ((__unused_webpack___webpack_module__, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ controller_default)
/* harmony export */ });
/* harmony import */ var core_js_modules_es_symbol_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! core-js/modules/es.symbol.js */ "./node_modules/core-js/modules/es.symbol.js");
/* harmony import */ var core_js_modules_es_symbol_description_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! core-js/modules/es.symbol.description.js */ "./node_modules/core-js/modules/es.symbol.description.js");
/* harmony import */ var core_js_modules_es_symbol_iterator_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! core-js/modules/es.symbol.iterator.js */ "./node_modules/core-js/modules/es.symbol.iterator.js");
/* harmony import */ var core_js_modules_es_symbol_to_primitive_js__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! core-js/modules/es.symbol.to-primitive.js */ "./node_modules/core-js/modules/es.symbol.to-primitive.js");
/* harmony import */ var core_js_modules_es_error_cause_js__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! core-js/modules/es.error.cause.js */ "./node_modules/core-js/modules/es.error.cause.js");
/* harmony import */ var core_js_modules_es_error_to_string_js__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! core-js/modules/es.error.to-string.js */ "./node_modules/core-js/modules/es.error.to-string.js");
/* harmony import */ var core_js_modules_es_array_concat_js__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! core-js/modules/es.array.concat.js */ "./node_modules/core-js/modules/es.array.concat.js");
/* harmony import */ var core_js_modules_es_array_every_js__WEBPACK_IMPORTED_MODULE_7__ = __webpack_require__(/*! core-js/modules/es.array.every.js */ "./node_modules/core-js/modules/es.array.every.js");
/* harmony import */ var core_js_modules_es_array_filter_js__WEBPACK_IMPORTED_MODULE_8__ = __webpack_require__(/*! core-js/modules/es.array.filter.js */ "./node_modules/core-js/modules/es.array.filter.js");
/* harmony import */ var core_js_modules_es_array_find_js__WEBPACK_IMPORTED_MODULE_9__ = __webpack_require__(/*! core-js/modules/es.array.find.js */ "./node_modules/core-js/modules/es.array.find.js");
/* harmony import */ var core_js_modules_es_array_for_each_js__WEBPACK_IMPORTED_MODULE_10__ = __webpack_require__(/*! core-js/modules/es.array.for-each.js */ "./node_modules/core-js/modules/es.array.for-each.js");
/* harmony import */ var core_js_modules_es_array_from_js__WEBPACK_IMPORTED_MODULE_11__ = __webpack_require__(/*! core-js/modules/es.array.from.js */ "./node_modules/core-js/modules/es.array.from.js");
/* harmony import */ var core_js_modules_es_array_includes_js__WEBPACK_IMPORTED_MODULE_12__ = __webpack_require__(/*! core-js/modules/es.array.includes.js */ "./node_modules/core-js/modules/es.array.includes.js");
/* harmony import */ var core_js_modules_es_array_is_array_js__WEBPACK_IMPORTED_MODULE_13__ = __webpack_require__(/*! core-js/modules/es.array.is-array.js */ "./node_modules/core-js/modules/es.array.is-array.js");
/* harmony import */ var core_js_modules_es_array_iterator_js__WEBPACK_IMPORTED_MODULE_14__ = __webpack_require__(/*! core-js/modules/es.array.iterator.js */ "./node_modules/core-js/modules/es.array.iterator.js");
/* harmony import */ var core_js_modules_es_array_map_js__WEBPACK_IMPORTED_MODULE_15__ = __webpack_require__(/*! core-js/modules/es.array.map.js */ "./node_modules/core-js/modules/es.array.map.js");
/* harmony import */ var core_js_modules_es_array_push_js__WEBPACK_IMPORTED_MODULE_16__ = __webpack_require__(/*! core-js/modules/es.array.push.js */ "./node_modules/core-js/modules/es.array.push.js");
/* harmony import */ var core_js_modules_es_array_reduce_js__WEBPACK_IMPORTED_MODULE_17__ = __webpack_require__(/*! core-js/modules/es.array.reduce.js */ "./node_modules/core-js/modules/es.array.reduce.js");
/* harmony import */ var core_js_modules_es_array_slice_js__WEBPACK_IMPORTED_MODULE_18__ = __webpack_require__(/*! core-js/modules/es.array.slice.js */ "./node_modules/core-js/modules/es.array.slice.js");
/* harmony import */ var core_js_modules_es_date_to_primitive_js__WEBPACK_IMPORTED_MODULE_19__ = __webpack_require__(/*! core-js/modules/es.date.to-primitive.js */ "./node_modules/core-js/modules/es.date.to-primitive.js");
/* harmony import */ var core_js_modules_es_date_to_string_js__WEBPACK_IMPORTED_MODULE_20__ = __webpack_require__(/*! core-js/modules/es.date.to-string.js */ "./node_modules/core-js/modules/es.date.to-string.js");
/* harmony import */ var core_js_modules_es_function_bind_js__WEBPACK_IMPORTED_MODULE_21__ = __webpack_require__(/*! core-js/modules/es.function.bind.js */ "./node_modules/core-js/modules/es.function.bind.js");
/* harmony import */ var core_js_modules_es_function_name_js__WEBPACK_IMPORTED_MODULE_22__ = __webpack_require__(/*! core-js/modules/es.function.name.js */ "./node_modules/core-js/modules/es.function.name.js");
/* harmony import */ var core_js_modules_es_number_constructor_js__WEBPACK_IMPORTED_MODULE_23__ = __webpack_require__(/*! core-js/modules/es.number.constructor.js */ "./node_modules/core-js/modules/es.number.constructor.js");
/* harmony import */ var core_js_modules_es_object_create_js__WEBPACK_IMPORTED_MODULE_24__ = __webpack_require__(/*! core-js/modules/es.object.create.js */ "./node_modules/core-js/modules/es.object.create.js");
/* harmony import */ var core_js_modules_es_object_define_properties_js__WEBPACK_IMPORTED_MODULE_25__ = __webpack_require__(/*! core-js/modules/es.object.define-properties.js */ "./node_modules/core-js/modules/es.object.define-properties.js");
/* harmony import */ var core_js_modules_es_object_define_property_js__WEBPACK_IMPORTED_MODULE_26__ = __webpack_require__(/*! core-js/modules/es.object.define-property.js */ "./node_modules/core-js/modules/es.object.define-property.js");
/* harmony import */ var core_js_modules_es_object_entries_js__WEBPACK_IMPORTED_MODULE_27__ = __webpack_require__(/*! core-js/modules/es.object.entries.js */ "./node_modules/core-js/modules/es.object.entries.js");
/* harmony import */ var core_js_modules_es_object_get_own_property_descriptor_js__WEBPACK_IMPORTED_MODULE_28__ = __webpack_require__(/*! core-js/modules/es.object.get-own-property-descriptor.js */ "./node_modules/core-js/modules/es.object.get-own-property-descriptor.js");
/* harmony import */ var core_js_modules_es_object_get_own_property_descriptors_js__WEBPACK_IMPORTED_MODULE_29__ = __webpack_require__(/*! core-js/modules/es.object.get-own-property-descriptors.js */ "./node_modules/core-js/modules/es.object.get-own-property-descriptors.js");
/* harmony import */ var core_js_modules_es_object_get_prototype_of_js__WEBPACK_IMPORTED_MODULE_30__ = __webpack_require__(/*! core-js/modules/es.object.get-prototype-of.js */ "./node_modules/core-js/modules/es.object.get-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_keys_js__WEBPACK_IMPORTED_MODULE_31__ = __webpack_require__(/*! core-js/modules/es.object.keys.js */ "./node_modules/core-js/modules/es.object.keys.js");
/* harmony import */ var core_js_modules_es_object_proto_js__WEBPACK_IMPORTED_MODULE_32__ = __webpack_require__(/*! core-js/modules/es.object.proto.js */ "./node_modules/core-js/modules/es.object.proto.js");
/* harmony import */ var core_js_modules_es_object_set_prototype_of_js__WEBPACK_IMPORTED_MODULE_33__ = __webpack_require__(/*! core-js/modules/es.object.set-prototype-of.js */ "./node_modules/core-js/modules/es.object.set-prototype-of.js");
/* harmony import */ var core_js_modules_es_object_to_string_js__WEBPACK_IMPORTED_MODULE_34__ = __webpack_require__(/*! core-js/modules/es.object.to-string.js */ "./node_modules/core-js/modules/es.object.to-string.js");
/* harmony import */ var core_js_modules_es_promise_js__WEBPACK_IMPORTED_MODULE_35__ = __webpack_require__(/*! core-js/modules/es.promise.js */ "./node_modules/core-js/modules/es.promise.js");
/* harmony import */ var core_js_modules_es_reflect_construct_js__WEBPACK_IMPORTED_MODULE_36__ = __webpack_require__(/*! core-js/modules/es.reflect.construct.js */ "./node_modules/core-js/modules/es.reflect.construct.js");
/* harmony import */ var core_js_modules_es_regexp_exec_js__WEBPACK_IMPORTED_MODULE_37__ = __webpack_require__(/*! core-js/modules/es.regexp.exec.js */ "./node_modules/core-js/modules/es.regexp.exec.js");
/* harmony import */ var core_js_modules_es_regexp_test_js__WEBPACK_IMPORTED_MODULE_38__ = __webpack_require__(/*! core-js/modules/es.regexp.test.js */ "./node_modules/core-js/modules/es.regexp.test.js");
/* harmony import */ var core_js_modules_es_regexp_to_string_js__WEBPACK_IMPORTED_MODULE_39__ = __webpack_require__(/*! core-js/modules/es.regexp.to-string.js */ "./node_modules/core-js/modules/es.regexp.to-string.js");
/* harmony import */ var core_js_modules_es_set_js__WEBPACK_IMPORTED_MODULE_40__ = __webpack_require__(/*! core-js/modules/es.set.js */ "./node_modules/core-js/modules/es.set.js");
/* harmony import */ var core_js_modules_es_set_difference_v2_js__WEBPACK_IMPORTED_MODULE_41__ = __webpack_require__(/*! core-js/modules/es.set.difference.v2.js */ "./node_modules/core-js/modules/es.set.difference.v2.js");
/* harmony import */ var core_js_modules_es_set_intersection_v2_js__WEBPACK_IMPORTED_MODULE_42__ = __webpack_require__(/*! core-js/modules/es.set.intersection.v2.js */ "./node_modules/core-js/modules/es.set.intersection.v2.js");
/* harmony import */ var core_js_modules_es_set_is_disjoint_from_v2_js__WEBPACK_IMPORTED_MODULE_43__ = __webpack_require__(/*! core-js/modules/es.set.is-disjoint-from.v2.js */ "./node_modules/core-js/modules/es.set.is-disjoint-from.v2.js");
/* harmony import */ var core_js_modules_es_set_is_subset_of_v2_js__WEBPACK_IMPORTED_MODULE_44__ = __webpack_require__(/*! core-js/modules/es.set.is-subset-of.v2.js */ "./node_modules/core-js/modules/es.set.is-subset-of.v2.js");
/* harmony import */ var core_js_modules_es_set_is_superset_of_v2_js__WEBPACK_IMPORTED_MODULE_45__ = __webpack_require__(/*! core-js/modules/es.set.is-superset-of.v2.js */ "./node_modules/core-js/modules/es.set.is-superset-of.v2.js");
/* harmony import */ var core_js_modules_es_set_symmetric_difference_v2_js__WEBPACK_IMPORTED_MODULE_46__ = __webpack_require__(/*! core-js/modules/es.set.symmetric-difference.v2.js */ "./node_modules/core-js/modules/es.set.symmetric-difference.v2.js");
/* harmony import */ var core_js_modules_es_set_union_v2_js__WEBPACK_IMPORTED_MODULE_47__ = __webpack_require__(/*! core-js/modules/es.set.union.v2.js */ "./node_modules/core-js/modules/es.set.union.v2.js");
/* harmony import */ var core_js_modules_es_string_includes_js__WEBPACK_IMPORTED_MODULE_48__ = __webpack_require__(/*! core-js/modules/es.string.includes.js */ "./node_modules/core-js/modules/es.string.includes.js");
/* harmony import */ var core_js_modules_es_string_iterator_js__WEBPACK_IMPORTED_MODULE_49__ = __webpack_require__(/*! core-js/modules/es.string.iterator.js */ "./node_modules/core-js/modules/es.string.iterator.js");
/* harmony import */ var core_js_modules_es_string_replace_js__WEBPACK_IMPORTED_MODULE_50__ = __webpack_require__(/*! core-js/modules/es.string.replace.js */ "./node_modules/core-js/modules/es.string.replace.js");
/* harmony import */ var core_js_modules_es_weak_map_js__WEBPACK_IMPORTED_MODULE_51__ = __webpack_require__(/*! core-js/modules/es.weak-map.js */ "./node_modules/core-js/modules/es.weak-map.js");
/* harmony import */ var core_js_modules_es_weak_set_js__WEBPACK_IMPORTED_MODULE_52__ = __webpack_require__(/*! core-js/modules/es.weak-set.js */ "./node_modules/core-js/modules/es.weak-set.js");
/* harmony import */ var core_js_modules_esnext_iterator_constructor_js__WEBPACK_IMPORTED_MODULE_53__ = __webpack_require__(/*! core-js/modules/esnext.iterator.constructor.js */ "./node_modules/core-js/modules/esnext.iterator.constructor.js");
/* harmony import */ var core_js_modules_esnext_iterator_filter_js__WEBPACK_IMPORTED_MODULE_54__ = __webpack_require__(/*! core-js/modules/esnext.iterator.filter.js */ "./node_modules/core-js/modules/esnext.iterator.filter.js");
/* harmony import */ var core_js_modules_esnext_iterator_find_js__WEBPACK_IMPORTED_MODULE_55__ = __webpack_require__(/*! core-js/modules/esnext.iterator.find.js */ "./node_modules/core-js/modules/esnext.iterator.find.js");
/* harmony import */ var core_js_modules_esnext_iterator_for_each_js__WEBPACK_IMPORTED_MODULE_56__ = __webpack_require__(/*! core-js/modules/esnext.iterator.for-each.js */ "./node_modules/core-js/modules/esnext.iterator.for-each.js");
/* harmony import */ var core_js_modules_esnext_iterator_map_js__WEBPACK_IMPORTED_MODULE_57__ = __webpack_require__(/*! core-js/modules/esnext.iterator.map.js */ "./node_modules/core-js/modules/esnext.iterator.map.js");
/* harmony import */ var core_js_modules_esnext_iterator_reduce_js__WEBPACK_IMPORTED_MODULE_58__ = __webpack_require__(/*! core-js/modules/esnext.iterator.reduce.js */ "./node_modules/core-js/modules/esnext.iterator.reduce.js");
/* harmony import */ var core_js_modules_web_dom_collections_for_each_js__WEBPACK_IMPORTED_MODULE_59__ = __webpack_require__(/*! core-js/modules/web.dom-collections.for-each.js */ "./node_modules/core-js/modules/web.dom-collections.for-each.js");
/* harmony import */ var core_js_modules_web_dom_collections_iterator_js__WEBPACK_IMPORTED_MODULE_60__ = __webpack_require__(/*! core-js/modules/web.dom-collections.iterator.js */ "./node_modules/core-js/modules/web.dom-collections.iterator.js");
/* harmony import */ var _hotwired_stimulus__WEBPACK_IMPORTED_MODULE_61__ = __webpack_require__(/*! @hotwired/stimulus */ "./node_modules/@hotwired/stimulus/dist/stimulus.js");
/* harmony import */ var tom_select__WEBPACK_IMPORTED_MODULE_62__ = __webpack_require__(/*! tom-select */ "./node_modules/tom-select/dist/esm/tom-select.complete.js");
function ownKeys(e, r) { var t = Object.keys(e); if (Object.getOwnPropertySymbols) { var o = Object.getOwnPropertySymbols(e); r && (o = o.filter(function (r) { return Object.getOwnPropertyDescriptor(e, r).enumerable; })), t.push.apply(t, o); } return t; }
function _objectSpread(e) { for (var r = 1; r < arguments.length; r++) { var t = null != arguments[r] ? arguments[r] : {}; r % 2 ? ownKeys(Object(t), !0).forEach(function (r) { _defineProperty(e, r, t[r]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(e, Object.getOwnPropertyDescriptors(t)) : ownKeys(Object(t)).forEach(function (r) { Object.defineProperty(e, r, Object.getOwnPropertyDescriptor(t, r)); }); } return e; }
function _defineProperty(e, r, t) { return (r = _toPropertyKey(r)) in e ? Object.defineProperty(e, r, { value: t, enumerable: !0, configurable: !0, writable: !0 }) : e[r] = t, e; }
function _slicedToArray(r, e) { return _arrayWithHoles(r) || _iterableToArrayLimit(r, e) || _unsupportedIterableToArray(r, e) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _iterableToArrayLimit(r, l) { var t = null == r ? null : "undefined" != typeof Symbol && r[Symbol.iterator] || r["@@iterator"]; if (null != t) { var e, n, i, u, a = [], f = !0, o = !1; try { if (i = (t = t.call(r)).next, 0 === l) { if (Object(t) !== t) return; f = !1; } else for (; !(f = (e = i.call(t)).done) && (a.push(e.value), a.length !== l); f = !0); } catch (r) { o = !0, n = r; } finally { try { if (!f && null != t["return"] && (u = t["return"](), Object(u) !== u)) return; } finally { if (o) throw n; } } return a; } }
function _arrayWithHoles(r) { if (Array.isArray(r)) return r; }
function _toConsumableArray(r) { return _arrayWithoutHoles(r) || _iterableToArray(r) || _unsupportedIterableToArray(r) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(r, a) { if (r) { if ("string" == typeof r) return _arrayLikeToArray(r, a); var t = {}.toString.call(r).slice(8, -1); return "Object" === t && r.constructor && (t = r.constructor.name), "Map" === t || "Set" === t ? Array.from(r) : "Arguments" === t || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(t) ? _arrayLikeToArray(r, a) : void 0; } }
function _iterableToArray(r) { if ("undefined" != typeof Symbol && null != r[Symbol.iterator] || null != r["@@iterator"]) return Array.from(r); }
function _arrayWithoutHoles(r) { if (Array.isArray(r)) return _arrayLikeToArray(r); }
function _arrayLikeToArray(r, a) { (null == a || a > r.length) && (a = r.length); for (var e = 0, n = Array(a); e < a; e++) n[e] = r[e]; return n; }
function _typeof(o) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (o) { return typeof o; } : function (o) { return o && "function" == typeof Symbol && o.constructor === Symbol && o !== Symbol.prototype ? "symbol" : typeof o; }, _typeof(o); }
function _classCallCheck(a, n) { if (!(a instanceof n)) throw new TypeError("Cannot call a class as a function"); }
function _defineProperties(e, r) { for (var t = 0; t < r.length; t++) { var o = r[t]; o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, _toPropertyKey(o.key), o); } }
function _createClass(e, r, t) { return r && _defineProperties(e.prototype, r), t && _defineProperties(e, t), Object.defineProperty(e, "prototype", { writable: !1 }), e; }
function _toPropertyKey(t) { var i = _toPrimitive(t, "string"); return "symbol" == _typeof(i) ? i : i + ""; }
function _toPrimitive(t, r) { if ("object" != _typeof(t) || !t) return t; var e = t[Symbol.toPrimitive]; if (void 0 !== e) { var i = e.call(t, r || "default"); if ("object" != _typeof(i)) return i; throw new TypeError("@@toPrimitive must return a primitive value."); } return ("string" === r ? String : Number)(t); }
function _callSuper(t, o, e) { return o = _getPrototypeOf(o), _possibleConstructorReturn(t, _isNativeReflectConstruct() ? Reflect.construct(o, e || [], _getPrototypeOf(t).constructor) : o.apply(t, e)); }
function _possibleConstructorReturn(t, e) { if (e && ("object" == _typeof(e) || "function" == typeof e)) return e; if (void 0 !== e) throw new TypeError("Derived constructors may only return object or undefined"); return _assertThisInitialized(t); }
function _assertThisInitialized(e) { if (void 0 === e) throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); return e; }
function _isNativeReflectConstruct() { try { var t = !Boolean.prototype.valueOf.call(Reflect.construct(Boolean, [], function () {})); } catch (t) {} return (_isNativeReflectConstruct = function _isNativeReflectConstruct() { return !!t; })(); }
function _getPrototypeOf(t) { return _getPrototypeOf = Object.setPrototypeOf ? Object.getPrototypeOf.bind() : function (t) { return t.__proto__ || Object.getPrototypeOf(t); }, _getPrototypeOf(t); }
function _inherits(t, e) { if ("function" != typeof e && null !== e) throw new TypeError("Super expression must either be null or a function"); t.prototype = Object.create(e && e.prototype, { constructor: { value: t, writable: !0, configurable: !0 } }), Object.defineProperty(t, "prototype", { writable: !1 }), e && _setPrototypeOf(t, e); }
function _setPrototypeOf(t, e) { return _setPrototypeOf = Object.setPrototypeOf ? Object.setPrototypeOf.bind() : function (t, e) { return t.__proto__ = e, t; }, _setPrototypeOf(t, e); }





























































var __typeError = function __typeError(msg) {
  throw TypeError(msg);
};
var __accessCheck = function __accessCheck(obj, member, msg) {
  return member.has(obj) || __typeError("Cannot " + msg);
};
var __privateGet = function __privateGet(obj, member, getter) {
  return __accessCheck(obj, member, "read from private field"), getter ? getter.call(obj) : member.get(obj);
};
var __privateAdd = function __privateAdd(obj, member, value) {
  return member.has(obj) ? __typeError("Cannot add the same private member more than once") : member instanceof WeakSet ? member.add(obj) : member.set(obj, value);
};
var __privateMethod = function __privateMethod(obj, member, method) {
  return __accessCheck(obj, member, "access private method"), method;
};

// src/controller.ts


var _instances, getCommonConfig_fn, createAutocomplete_fn, createAutocompleteWithHtmlContents_fn, createAutocompleteWithRemoteData_fn, stripTags_fn, mergeConfigs_fn, _normalizePluginsToHash, normalizePlugins_fn, createTomSelect_fn;
var controller_default = /*#__PURE__*/function (_Controller) {
  function controller_default() {
    var _this;
    _classCallCheck(this, controller_default);
    _this = _callSuper(this, controller_default, arguments);
    __privateAdd(_this, _instances);
    _this.isObserving = false;
    _this.hasLoadedChoicesPreviously = false;
    _this.originalOptions = [];
    /**
     * Normalizes the plugins to a hash, so that we can merge them easily.
     */
    __privateAdd(_this, _normalizePluginsToHash, function (plugins) {
      if (Array.isArray(plugins)) {
        return plugins.reduce(function (acc, plugin) {
          if (typeof plugin === "string") {
            acc[plugin] = {};
          }
          if (_typeof(plugin) === "object" && plugin.name) {
            acc[plugin.name] = plugin.options || {};
          }
          return acc;
        }, {});
      }
      return plugins;
    });
    return _this;
  }
  _inherits(controller_default, _Controller);
  return _createClass(controller_default, [{
    key: "initialize",
    value: function initialize() {
      var _this2 = this;
      if (!this.mutationObserver) {
        this.mutationObserver = new MutationObserver(function (mutations) {
          _this2.onMutations(mutations);
        });
      }
    }
  }, {
    key: "connect",
    value: function connect() {
      if (this.selectElement) {
        this.originalOptions = this.createOptionsDataStructure(this.selectElement);
      }
      this.initializeTomSelect();
    }
  }, {
    key: "initializeTomSelect",
    value: function initializeTomSelect() {
      if (this.selectElement) {
        this.selectElement.setAttribute("data-skip-morph", "");
      }
      if (this.urlValue) {
        this.tomSelect = __privateMethod(this, _instances, createAutocompleteWithRemoteData_fn).call(this, this.urlValue, this.hasMinCharactersValue ? this.minCharactersValue : null);
        return;
      }
      if (this.optionsAsHtmlValue) {
        this.tomSelect = __privateMethod(this, _instances, createAutocompleteWithHtmlContents_fn).call(this);
        return;
      }
      this.tomSelect = __privateMethod(this, _instances, createAutocomplete_fn).call(this);
      this.startMutationObserver();
    }
  }, {
    key: "disconnect",
    value: function disconnect() {
      this.stopMutationObserver();
      var currentSelectedValues = [];
      if (this.selectElement) {
        if (this.selectElement.multiple) {
          currentSelectedValues = Array.from(this.selectElement.options).filter(function (option) {
            return option.selected;
          }).map(function (option) {
            return option.value;
          });
        } else {
          currentSelectedValues = [this.selectElement.value];
        }
      }
      this.tomSelect.destroy();
      if (this.selectElement) {
        if (this.selectElement.multiple) {
          Array.from(this.selectElement.options).forEach(function (option) {
            option.selected = currentSelectedValues.includes(option.value);
          });
        } else {
          this.selectElement.value = currentSelectedValues[0];
        }
      }
    }
  }, {
    key: "urlValueChanged",
    value: function urlValueChanged() {
      this.resetTomSelect();
    }
  }, {
    key: "getMaxOptions",
    value: function getMaxOptions() {
      return this.selectElement ? this.selectElement.options.length : 50;
    }
    /**
     * Returns the element, but only if it's a select element.
     */
  }, {
    key: "selectElement",
    get: function get() {
      if (!(this.element instanceof HTMLSelectElement)) {
        return null;
      }
      return this.element;
    }
    /**
     * Getter to help typing.
     */
  }, {
    key: "formElement",
    get: function get() {
      if (!(this.element instanceof HTMLInputElement) && !(this.element instanceof HTMLSelectElement)) {
        throw new Error("Autocomplete Stimulus controller can only be used on an <input> or <select>.");
      }
      return this.element;
    }
  }, {
    key: "dispatchEvent",
    value: function dispatchEvent(name, payload) {
      this.dispatch(name, {
        detail: payload,
        prefix: "autocomplete"
      });
    }
  }, {
    key: "preload",
    get: function get() {
      if (!this.hasPreloadValue) {
        return "focus";
      }
      if (this.preloadValue === "false") {
        return false;
      }
      if (this.preloadValue === "true") {
        return true;
      }
      return this.preloadValue;
    }
  }, {
    key: "resetTomSelect",
    value: function resetTomSelect() {
      if (this.tomSelect) {
        this.dispatchEvent("before-reset", {
          tomSelect: this.tomSelect
        });
        this.stopMutationObserver();
        var currentHtml = this.element.innerHTML;
        var currentValue = this.tomSelect.getValue();
        this.tomSelect.destroy();
        this.element.innerHTML = currentHtml;
        this.initializeTomSelect();
        this.tomSelect.setValue(currentValue);
      }
    }
  }, {
    key: "changeTomSelectDisabledState",
    value: function changeTomSelectDisabledState(isDisabled) {
      this.stopMutationObserver();
      if (isDisabled) {
        this.tomSelect.disable();
      } else {
        this.tomSelect.enable();
      }
      this.startMutationObserver();
    }
  }, {
    key: "startMutationObserver",
    value: function startMutationObserver() {
      if (!this.isObserving && this.mutationObserver) {
        this.mutationObserver.observe(this.element, {
          childList: true,
          subtree: true,
          attributes: true,
          characterData: true,
          attributeOldValue: true
        });
        this.isObserving = true;
      }
    }
  }, {
    key: "stopMutationObserver",
    value: function stopMutationObserver() {
      if (this.isObserving && this.mutationObserver) {
        this.mutationObserver.disconnect();
        this.isObserving = false;
      }
    }
  }, {
    key: "onMutations",
    value: function onMutations(mutations) {
      var _this3 = this;
      var changeDisabledState = false;
      var requireReset = false;
      mutations.forEach(function (mutation) {
        switch (mutation.type) {
          case "attributes":
            if (mutation.target === _this3.element && mutation.attributeName === "disabled") {
              changeDisabledState = true;
              break;
            }
            if (mutation.target === _this3.element && mutation.attributeName === "multiple") {
              var isNowMultiple = _this3.element.hasAttribute("multiple");
              var wasMultiple = mutation.oldValue === "multiple";
              if (isNowMultiple !== wasMultiple) {
                requireReset = true;
              }
              break;
            }
            break;
        }
      });
      var newOptions = this.selectElement ? this.createOptionsDataStructure(this.selectElement) : [];
      var areOptionsEquivalent = this.areOptionsEquivalent(newOptions);
      if (!areOptionsEquivalent || requireReset) {
        this.originalOptions = newOptions;
        this.resetTomSelect();
      }
      if (changeDisabledState) {
        this.changeTomSelectDisabledState(this.formElement.disabled);
      }
    }
  }, {
    key: "createOptionsDataStructure",
    value: function createOptionsDataStructure(selectElement) {
      return Array.from(selectElement.options).map(function (option) {
        return {
          value: option.value,
          text: option.text
        };
      });
    }
  }, {
    key: "areOptionsEquivalent",
    value: function areOptionsEquivalent(newOptions) {
      var filteredOriginalOptions = this.originalOptions.filter(function (option) {
        return option.value !== "";
      });
      var filteredNewOptions = newOptions.filter(function (option) {
        return option.value !== "";
      });
      var originalPlaceholderOption = this.originalOptions.find(function (option) {
        return option.value === "";
      });
      var newPlaceholderOption = newOptions.find(function (option) {
        return option.value === "";
      });
      if (originalPlaceholderOption && newPlaceholderOption && originalPlaceholderOption.text !== newPlaceholderOption.text) {
        return false;
      }
      if (filteredOriginalOptions.length !== filteredNewOptions.length) {
        return false;
      }
      var normalizeOption = function normalizeOption(option) {
        return "".concat(option.value, "-").concat(option.text);
      };
      var originalOptionsSet = new Set(filteredOriginalOptions.map(normalizeOption));
      var newOptionsSet = new Set(filteredNewOptions.map(normalizeOption));
      return originalOptionsSet.size === newOptionsSet.size && _toConsumableArray(originalOptionsSet).every(function (option) {
        return newOptionsSet.has(option);
      });
    }
  }]);
}(_hotwired_stimulus__WEBPACK_IMPORTED_MODULE_61__.Controller);
_instances = new WeakSet();
getCommonConfig_fn = function getCommonConfig_fn() {
  var _this4 = this;
  var plugins = {};
  var isMultiple = !this.selectElement || this.selectElement.multiple;
  if (!this.formElement.disabled && !isMultiple) {
    plugins.clear_button = {
      title: ""
    };
  }
  if (isMultiple) {
    plugins.remove_button = {
      title: ""
    };
  }
  if (this.urlValue) {
    plugins.virtual_scroll = {};
  }
  var render = {
    no_results: function no_results() {
      return "<div class=\"no-results\">".concat(_this4.noResultsFoundTextValue, "</div>");
    },
    option_create: function option_create(data, escapeData) {
      return "<div class=\"create\">".concat(_this4.createOptionTextValue.replace("%placeholder%", "<strong>".concat(escapeData(data.input), "</strong>")), "</div>");
    }
  };
  var config = {
    render: render,
    plugins: plugins,
    // clear the text input after selecting a value
    onItemAdd: function onItemAdd() {
      _this4.tomSelect.setTextboxValue("");
    },
    closeAfterSelect: true,
    // fix positioning (in the dropdown) of options added through addOption()
    onOptionAdd: function onOptionAdd(value, data) {
      var parentElement = _this4.tomSelect.input;
      var optgroupData = null;
      var optgroup = data[_this4.tomSelect.settings.optgroupField];
      if (optgroup && _this4.tomSelect.optgroups) {
        optgroupData = _this4.tomSelect.optgroups[optgroup];
        if (optgroupData) {
          var optgroupElement = parentElement.querySelector("optgroup[label=\"".concat(optgroupData.label, "\"]"));
          if (optgroupElement) {
            parentElement = optgroupElement;
          }
        }
      }
      var optionElement = document.createElement("option");
      optionElement.value = value;
      optionElement.text = data[_this4.tomSelect.settings.labelField];
      var optionOrder = data.$order;
      var orderedOption = null;
      for (var _i = 0, _Object$entries = Object.entries(_this4.tomSelect.options); _i < _Object$entries.length; _i++) {
        var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
          tomSelectOption = _Object$entries$_i[1];
        if (tomSelectOption.$order === optionOrder) {
          orderedOption = parentElement.querySelector(":scope > option[value=\"".concat(CSS.escape(tomSelectOption[_this4.tomSelect.settings.valueField]), "\"]"));
          break;
        }
      }
      if (orderedOption) {
        orderedOption.insertAdjacentElement("afterend", optionElement);
      } else if (optionOrder >= 0) {
        parentElement.append(optionElement);
      } else {
        parentElement.prepend(optionElement);
      }
    }
  };
  if (!this.selectElement && !this.urlValue) {
    config.shouldLoad = function () {
      return false;
    };
  }
  return __privateMethod(this, _instances, mergeConfigs_fn).call(this, config, this.tomSelectOptionsValue);
};
createAutocomplete_fn = function createAutocomplete_fn() {
  var config = __privateMethod(this, _instances, mergeConfigs_fn).call(this, __privateMethod(this, _instances, getCommonConfig_fn).call(this), {
    maxOptions: this.getMaxOptions()
  });
  return __privateMethod(this, _instances, createTomSelect_fn).call(this, config);
};
createAutocompleteWithHtmlContents_fn = function createAutocompleteWithHtmlContents_fn() {
  var _commonConfig$labelFi,
    _this5 = this;
  var commonConfig = __privateMethod(this, _instances, getCommonConfig_fn).call(this);
  var labelField = (_commonConfig$labelFi = commonConfig.labelField) !== null && _commonConfig$labelFi !== void 0 ? _commonConfig$labelFi : "text";
  var config = __privateMethod(this, _instances, mergeConfigs_fn).call(this, commonConfig, {
    maxOptions: this.getMaxOptions(),
    score: function score(search) {
      var scoringFunction = _this5.tomSelect.getScoreFunction(search);
      return function (item) {
        return scoringFunction(_objectSpread(_objectSpread({}, item), {}, {
          text: __privateMethod(_this5, _instances, stripTags_fn).call(_this5, item[labelField])
        }));
      };
    },
    render: {
      item: function item(_item) {
        return "<div>".concat(_item[labelField], "</div>");
      },
      option: function option(item) {
        return "<div>".concat(item[labelField], "</div>");
      }
    }
  });
  return __privateMethod(this, _instances, createTomSelect_fn).call(this, config);
};
createAutocompleteWithRemoteData_fn = function createAutocompleteWithRemoteData_fn(autocompleteEndpointUrl, minCharacterLength) {
  var _commonConfig$labelFi2,
    _this7 = this;
  var commonConfig = __privateMethod(this, _instances, getCommonConfig_fn).call(this);
  var labelField = (_commonConfig$labelFi2 = commonConfig.labelField) !== null && _commonConfig$labelFi2 !== void 0 ? _commonConfig$labelFi2 : "text";
  var config = __privateMethod(this, _instances, mergeConfigs_fn).call(this, commonConfig, {
    firstUrl: function firstUrl(query) {
      var separator = autocompleteEndpointUrl.includes("?") ? "&" : "?";
      return "".concat(autocompleteEndpointUrl).concat(separator, "query=").concat(encodeURIComponent(query));
    },
    // VERY IMPORTANT: use 'function (query, callback) { ... }' instead of the
    // '(query, callback) => { ... }' syntax because, otherwise,
    // the 'this.XXX' calls inside this method fail
    load: function load(query, callback) {
      var _this6 = this;
      var url = this.getUrl(query);
      fetch(url).then(function (response) {
        return response.json();
      }).then(function (json) {
        _this6.setNextUrl(query, json.next_page);
        callback(json.results.options || json.results, json.results.optgroups || []);
      })["catch"](function () {
        return callback([], []);
      });
    },
    shouldLoad: function shouldLoad(query) {
      if (null !== minCharacterLength) {
        return query.length >= minCharacterLength;
      }
      if (_this7.hasLoadedChoicesPreviously) {
        return true;
      }
      if (query.length > 0) {
        _this7.hasLoadedChoicesPreviously = true;
      }
      return query.length >= 3;
    },
    optgroupField: "group_by",
    // avoid extra filtering after results are returned
    score: function score(search) {
      return function (item) {
        return 1;
      };
    },
    render: {
      option: function option(item) {
        return "<div>".concat(item[labelField], "</div>");
      },
      item: function item(_item2) {
        return "<div>".concat(_item2[labelField], "</div>");
      },
      loading_more: function loading_more() {
        return "<div class=\"loading-more-results\">".concat(_this7.loadingMoreTextValue, "</div>");
      },
      no_more_results: function no_more_results() {
        return "<div class=\"no-more-results\">".concat(_this7.noMoreResultsTextValue, "</div>");
      },
      no_results: function no_results() {
        return "<div class=\"no-results\">".concat(_this7.noResultsFoundTextValue, "</div>");
      },
      option_create: function option_create(data, escapeData) {
        return "<div class=\"create\">".concat(_this7.createOptionTextValue.replace("%placeholder%", "<strong>".concat(escapeData(data.input), "</strong>")), "</div>");
      }
    },
    preload: this.preload
  });
  return __privateMethod(this, _instances, createTomSelect_fn).call(this, config);
};
stripTags_fn = function stripTags_fn(string) {
  return string.replace(/(<([^>]+)>)/gi, "");
};
mergeConfigs_fn = function mergeConfigs_fn(config1, config2) {
  return _objectSpread(_objectSpread(_objectSpread({}, config1), config2), {}, {
    // Plugins from both configs should be merged together.
    plugins: __privateMethod(this, _instances, normalizePlugins_fn).call(this, _objectSpread(_objectSpread({}, __privateGet(this, _normalizePluginsToHash).call(this, config1.plugins || {})), __privateGet(this, _normalizePluginsToHash).call(this, config2.plugins || {})))
  });
};
_normalizePluginsToHash = new WeakMap();
normalizePlugins_fn = function normalizePlugins_fn(plugins) {
  return Object.entries(plugins).reduce(function (acc, _ref) {
    var _ref2 = _slicedToArray(_ref, 2),
      pluginName = _ref2[0],
      pluginOptions = _ref2[1];
    if (pluginOptions !== false) {
      acc[pluginName] = pluginOptions;
    }
    return acc;
  }, {});
};
createTomSelect_fn = function createTomSelect_fn(options) {
  var preConnectPayload = {
    options: options
  };
  this.dispatchEvent("pre-connect", preConnectPayload);
  var tomSelect = new tom_select__WEBPACK_IMPORTED_MODULE_62__["default"](this.formElement, options);
  var connectPayload = {
    tomSelect: tomSelect,
    options: options
  };
  this.dispatchEvent("connect", connectPayload);
  return tomSelect;
};
controller_default.values = {
  url: String,
  optionsAsHtml: Boolean,
  loadingMoreText: String,
  noResultsFoundText: String,
  noMoreResultsText: String,
  createOptionText: String,
  minCharacters: Number,
  tomSelectOptions: Object,
  preload: String
};


/***/ })

},
/******/ __webpack_require__ => { // webpackRuntimeModules
/******/ var __webpack_exec__ = (moduleId) => (__webpack_require__(__webpack_require__.s = moduleId))
/******/ __webpack_require__.O(0, ["vendors-node_modules_symfony_stimulus-bridge_dist_index_js-node_modules_tom-select_dist_css_t-336076"], () => (__webpack_exec__("./assets/app.js")));
/******/ var __webpack_exports__ = __webpack_require__.O();
/******/ }
]);
//# sourceMappingURL=data:application/json;charset=utf-8;base64,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Qk8sYUFBYSxFQUFFQyxNQUFNO0VBQ3JCQyxnQkFBZ0IsRUFBRXBFLE1BQU07RUFDeEIrQyxPQUFPLEVBQUVZO0FBQ1gsQ0FBQyIsInNvdXJjZXMiOlsid2VicGFjazovLy8uL2Fzc2V0cy9hcHAuanMiLCJ3ZWJwYWNrOi8vLyBcXC5banRdc3giLCJ3ZWJwYWNrOi8vLy4vYXNzZXRzL3N0aW11bHVzX2Jvb3RzdHJhcC5qcyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvc3R5bGVzL2FwcC5jc3M/M2ZiYSIsIndlYnBhY2s6Ly8vLi9hc3NldHMvY29udHJvbGxlcnMuanNvbiIsIndlYnBhY2s6Ly8vLi9hc3NldHMvY29udHJvbGxlcnMvY3NyZl9wcm90ZWN0aW9uX2NvbnRyb2xsZXIuanM/NWIwMyIsIndlYnBhY2s6Ly8vLi9hc3NldHMvY29udHJvbGxlcnMvaGVsbG9fY29udHJvbGxlci5qcyIsIndlYnBhY2s6Ly8vLi92ZW5kb3Ivc3ltZm9ueS91eC1hdXRvY29tcGxldGUvYXNzZXRzL2Rpc3QvY29udHJvbGxlci5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyJpbXBvcnQgJy4vc3RpbXVsdXNfYm9vdHN0cmFwLmpzJztcbi8vaW1wb3J0ICcuL2Jvb3RzdHJhcC5qcyc7XG4vKlxuICogV2VsY29tZSB0byB5b3VyIGFwcCdzIG1haW4gSmF2YVNjcmlwdCBmaWxlIVxuICpcbiAqIFdlIHJlY29tbWVuZCBpbmNsdWRpbmcgdGhlIGJ1aWx0IHZlcnNpb24gb2YgdGhpcyBKYXZhU2NyaXB0IGZpbGVcbiAqIChhbmQgaXRzIENTUyBmaWxlKSBpbiB5b3VyIGJhc2UgbGF5b3V0IChiYXNlLmh0bWwudHdpZykuXG4gKi9cblxuLy8gYW55IENTUyB5b3UgaW1wb3J0IHdpbGwgb3V0cHV0IGludG8gYSBzaW5nbGUgY3NzIGZpbGUgKGFwcC5jc3MgaW4gdGhpcyBjYXNlKVxuaW1wb3J0ICcuL3N0eWxlcy9hcHAuY3NzJztcbiIsInZhciBtYXAgPSB7XG5cdFwiLi9jc3JmX3Byb3RlY3Rpb25fY29udHJvbGxlci5qc1wiOiBcIi4vbm9kZV9tb2R1bGVzL0BzeW1mb255L3N0aW11bHVzLWJyaWRnZS9sYXp5LWNvbnRyb2xsZXItbG9hZGVyLmpzIS4vYXNzZXRzL2NvbnRyb2xsZXJzL2NzcmZfcHJvdGVjdGlvbl9jb250cm9sbGVyLmpzXCIsXG5cdFwiLi9oZWxsb19jb250cm9sbGVyLmpzXCI6IFwiLi9ub2RlX21vZHVsZXMvQHN5bWZvbnkvc3RpbXVsdXMtYnJpZGdlL2xhenktY29udHJvbGxlci1sb2FkZXIuanMhLi9hc3NldHMvY29udHJvbGxlcnMvaGVsbG9fY29udHJvbGxlci5qc1wiXG59O1xuXG5cbmZ1bmN0aW9uIHdlYnBhY2tDb250ZXh0KHJlcSkge1xuXHR2YXIgaWQgPSB3ZWJwYWNrQ29udGV4dFJlc29sdmUocmVxKTtcblx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oaWQpO1xufVxuZnVuY3Rpb24gd2VicGFja0NvbnRleHRSZXNvbHZlKHJlcSkge1xuXHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKG1hcCwgcmVxKSkge1xuXHRcdHZhciBlID0gbmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIiArIHJlcSArIFwiJ1wiKTtcblx0XHRlLmNvZGUgPSAnTU9EVUxFX05PVF9GT1VORCc7XG5cdFx0dGhyb3cgZTtcblx0fVxuXHRyZXR1cm4gbWFwW3JlcV07XG59XG53ZWJwYWNrQ29udGV4dC5rZXlzID0gZnVuY3Rpb24gd2VicGFja0NvbnRleHRLZXlzKCkge1xuXHRyZXR1cm4gT2JqZWN0LmtleXMobWFwKTtcbn07XG53ZWJwYWNrQ29udGV4dC5yZXNvbHZlID0gd2VicGFja0NvbnRleHRSZXNvbHZlO1xubW9kdWxlLmV4cG9ydHMgPSB3ZWJwYWNrQ29udGV4dDtcbndlYnBhY2tDb250ZXh0LmlkID0gXCIuL2Fzc2V0cy9jb250cm9sbGVycyBzeW5jIHJlY3Vyc2l2ZSAuL25vZGVfbW9kdWxlcy9Ac3ltZm9ueS9zdGltdWx1cy1icmlkZ2UvbGF6eS1jb250cm9sbGVyLWxvYWRlci5qcyEgXFxcXC5banRdc3g/JFwiOyIsImltcG9ydCB7IHN0YXJ0U3RpbXVsdXNBcHAgfSBmcm9tICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UnO1xuXG4vLyBSZWdpc3RlcnMgU3RpbXVsdXMgY29udHJvbGxlcnMgZnJvbSBjb250cm9sbGVycy5qc29uIGFuZCBpbiB0aGUgY29udHJvbGxlcnMvIGRpcmVjdG9yeVxuZXhwb3J0IGNvbnN0IGFwcCA9IHN0YXJ0U3RpbXVsdXNBcHAocmVxdWlyZS5jb250ZXh0KFxuICAgICdAc3ltZm9ueS9zdGltdWx1cy1icmlkZ2UvbGF6eS1jb250cm9sbGVyLWxvYWRlciEuL2NvbnRyb2xsZXJzJyxcbiAgICB0cnVlLFxuICAgIC9cXC5banRdc3g/JC9cbikpO1xuLy8gcmVnaXN0ZXIgYW55IGN1c3RvbSwgM3JkIHBhcnR5IGNvbnRyb2xsZXJzIGhlcmVcbi8vIGFwcC5yZWdpc3Rlcignc29tZV9jb250cm9sbGVyX25hbWUnLCBTb21lSW1wb3J0ZWRDb250cm9sbGVyKTsiLCIvLyBleHRyYWN0ZWQgYnkgbWluaS1jc3MtZXh0cmFjdC1wbHVnaW5cbmV4cG9ydCB7fTsiLCJpbXBvcnQgY29udHJvbGxlcl8wIGZyb20gJ0BzeW1mb255L3V4LWF1dG9jb21wbGV0ZS9kaXN0L2NvbnRyb2xsZXIuanMnO1xuaW1wb3J0ICd0b20tc2VsZWN0L2Rpc3QvY3NzL3RvbS1zZWxlY3QuZGVmYXVsdC5jc3MnO1xuZXhwb3J0IGRlZmF1bHQge1xuICAnc3ltZm9ueS0tdXgtYXV0b2NvbXBsZXRlLS1hdXRvY29tcGxldGUnOiBjb250cm9sbGVyXzAsXG59OyIsImltcG9ydCB7IENvbnRyb2xsZXIgfSBmcm9tICdAaG90d2lyZWQvc3RpbXVsdXMnO1xuY29uc3QgY29udHJvbGxlciA9IGNsYXNzIGV4dGVuZHMgQ29udHJvbGxlciB7XG4gICAgY29uc3RydWN0b3IoY29udGV4dCkge1xuICAgICAgICBzdXBlcihjb250ZXh0KTtcbiAgICAgICAgdGhpcy5fX3N0aW11bHVzTGF6eUNvbnRyb2xsZXIgPSB0cnVlO1xuICAgIH1cbiAgICBpbml0aWFsaXplKCkge1xuICAgICAgICBpZiAodGhpcy5hcHBsaWNhdGlvbi5jb250cm9sbGVycy5maW5kKChjb250cm9sbGVyKSA9PiB7XG4gICAgICAgICAgICByZXR1cm4gY29udHJvbGxlci5pZGVudGlmaWVyID09PSB0aGlzLmlkZW50aWZpZXIgJiYgY29udHJvbGxlci5fX3N0aW11bHVzTGF6eUNvbnRyb2xsZXI7XG4gICAgICAgIH0pKSB7XG4gICAgICAgICAgICByZXR1cm47XG4gICAgICAgIH1cbiAgICAgICAgaW1wb3J0KCcvdmFyL3d3dy9lZmFjL2Fzc2V0cy9jb250cm9sbGVycy9jc3JmX3Byb3RlY3Rpb25fY29udHJvbGxlci5qcycpLnRoZW4oKGNvbnRyb2xsZXIpID0+IHtcbiAgICAgICAgICAgIHRoaXMuYXBwbGljYXRpb24ucmVnaXN0ZXIodGhpcy5pZGVudGlmaWVyLCBjb250cm9sbGVyLmRlZmF1bHQpO1xuICAgICAgICB9KTtcbiAgICB9XG59O1xuZXhwb3J0IHsgY29udHJvbGxlciBhcyBkZWZhdWx0IH07IiwiaW1wb3J0IHsgQ29udHJvbGxlciB9IGZyb20gJ0Bob3R3aXJlZC9zdGltdWx1cyc7XG5cbi8qXG4gKiBUaGlzIGlzIGFuIGV4YW1wbGUgU3RpbXVsdXMgY29udHJvbGxlciFcbiAqXG4gKiBBbnkgZWxlbWVudCB3aXRoIGEgZGF0YS1jb250cm9sbGVyPVwiaGVsbG9cIiBhdHRyaWJ1dGUgd2lsbCBjYXVzZVxuICogdGhpcyBjb250cm9sbGVyIHRvIGJlIGV4ZWN1dGVkLiBUaGUgbmFtZSBcImhlbGxvXCIgY29tZXMgZnJvbSB0aGUgZmlsZW5hbWU6XG4gKiBoZWxsb19jb250cm9sbGVyLmpzIC0+IFwiaGVsbG9cIlxuICpcbiAqIERlbGV0ZSB0aGlzIGZpbGUgb3IgYWRhcHQgaXQgZm9yIHlvdXIgdXNlIVxuICovXG5leHBvcnQgZGVmYXVsdCBjbGFzcyBleHRlbmRzIENvbnRyb2xsZXIge1xuICAgIGNvbm5lY3QoKSB7XG4gICAgICAgIHRoaXMuZWxlbWVudC50ZXh0Q29udGVudCA9ICdIZWxsbyBTdGltdWx1cyEgRWRpdCBtZSBpbiBhc3NldHMvY29udHJvbGxlcnMvaGVsbG9fY29udHJvbGxlci5qcyc7XG4gICAgfVxufVxuIiwidmFyIF9fdHlwZUVycm9yID0gKG1zZykgPT4ge1xuICB0aHJvdyBUeXBlRXJyb3IobXNnKTtcbn07XG52YXIgX19hY2Nlc3NDaGVjayA9IChvYmosIG1lbWJlciwgbXNnKSA9PiBtZW1iZXIuaGFzKG9iaikgfHwgX190eXBlRXJyb3IoXCJDYW5ub3QgXCIgKyBtc2cpO1xudmFyIF9fcHJpdmF0ZUdldCA9IChvYmosIG1lbWJlciwgZ2V0dGVyKSA9PiAoX19hY2Nlc3NDaGVjayhvYmosIG1lbWJlciwgXCJyZWFkIGZyb20gcHJpdmF0ZSBmaWVsZFwiKSwgZ2V0dGVyID8gZ2V0dGVyLmNhbGwob2JqKSA6IG1lbWJlci5nZXQob2JqKSk7XG52YXIgX19wcml2YXRlQWRkID0gKG9iaiwgbWVtYmVyLCB2YWx1ZSkgPT4gbWVtYmVyLmhhcyhvYmopID8gX190eXBlRXJyb3IoXCJDYW5ub3QgYWRkIHRoZSBzYW1lIHByaXZhdGUgbWVtYmVyIG1vcmUgdGhhbiBvbmNlXCIpIDogbWVtYmVyIGluc3RhbmNlb2YgV2Vha1NldCA/IG1lbWJlci5hZGQob2JqKSA6IG1lbWJlci5zZXQob2JqLCB2YWx1ZSk7XG52YXIgX19wcml2YXRlTWV0aG9kID0gKG9iaiwgbWVtYmVyLCBtZXRob2QpID0+IChfX2FjY2Vzc0NoZWNrKG9iaiwgbWVtYmVyLCBcImFjY2VzcyBwcml2YXRlIG1ldGhvZFwiKSwgbWV0aG9kKTtcblxuLy8gc3JjL2NvbnRyb2xsZXIudHNcbmltcG9ydCB7IENvbnRyb2xsZXIgfSBmcm9tIFwiQGhvdHdpcmVkL3N0aW11bHVzXCI7XG5pbXBvcnQgVG9tU2VsZWN0IGZyb20gXCJ0b20tc2VsZWN0XCI7XG52YXIgX2luc3RhbmNlcywgZ2V0Q29tbW9uQ29uZmlnX2ZuLCBjcmVhdGVBdXRvY29tcGxldGVfZm4sIGNyZWF0ZUF1dG9jb21wbGV0ZVdpdGhIdG1sQ29udGVudHNfZm4sIGNyZWF0ZUF1dG9jb21wbGV0ZVdpdGhSZW1vdGVEYXRhX2ZuLCBzdHJpcFRhZ3NfZm4sIG1lcmdlQ29uZmlnc19mbiwgX25vcm1hbGl6ZVBsdWdpbnNUb0hhc2gsIG5vcm1hbGl6ZVBsdWdpbnNfZm4sIGNyZWF0ZVRvbVNlbGVjdF9mbjtcbnZhciBjb250cm9sbGVyX2RlZmF1bHQgPSBjbGFzcyBleHRlbmRzIENvbnRyb2xsZXIge1xuICBjb25zdHJ1Y3RvcigpIHtcbiAgICBzdXBlciguLi5hcmd1bWVudHMpO1xuICAgIF9fcHJpdmF0ZUFkZCh0aGlzLCBfaW5zdGFuY2VzKTtcbiAgICB0aGlzLmlzT2JzZXJ2aW5nID0gZmFsc2U7XG4gICAgdGhpcy5oYXNMb2FkZWRDaG9pY2VzUHJldmlvdXNseSA9IGZhbHNlO1xuICAgIHRoaXMub3JpZ2luYWxPcHRpb25zID0gW107XG4gICAgLyoqXG4gICAgICogTm9ybWFsaXplcyB0aGUgcGx1Z2lucyB0byBhIGhhc2gsIHNvIHRoYXQgd2UgY2FuIG1lcmdlIHRoZW0gZWFzaWx5LlxuICAgICAqL1xuICAgIF9fcHJpdmF0ZUFkZCh0aGlzLCBfbm9ybWFsaXplUGx1Z2luc1RvSGFzaCwgKHBsdWdpbnMpID0+IHtcbiAgICAgIGlmIChBcnJheS5pc0FycmF5KHBsdWdpbnMpKSB7XG4gICAgICAgIHJldHVybiBwbHVnaW5zLnJlZHVjZSgoYWNjLCBwbHVnaW4pID0+IHtcbiAgICAgICAgICBpZiAodHlwZW9mIHBsdWdpbiA9PT0gXCJzdHJpbmdcIikge1xuICAgICAgICAgICAgYWNjW3BsdWdpbl0gPSB7fTtcbiAgICAgICAgICB9XG4gICAgICAgICAgaWYgKHR5cGVvZiBwbHVnaW4gPT09IFwib2JqZWN0XCIgJiYgcGx1Z2luLm5hbWUpIHtcbiAgICAgICAgICAgIGFjY1twbHVnaW4ubmFtZV0gPSBwbHVnaW4ub3B0aW9ucyB8fCB7fTtcbiAgICAgICAgICB9XG4gICAgICAgICAgcmV0dXJuIGFjYztcbiAgICAgICAgfSwge30pO1xuICAgICAgfVxuICAgICAgcmV0dXJuIHBsdWdpbnM7XG4gICAgfSk7XG4gIH1cbiAgaW5pdGlhbGl6ZSgpIHtcbiAgICBpZiAoIXRoaXMubXV0YXRpb25PYnNlcnZlcikge1xuICAgICAgdGhpcy5tdXRhdGlvbk9ic2VydmVyID0gbmV3IE11dGF0aW9uT2JzZXJ2ZXIoKG11dGF0aW9ucykgPT4ge1xuICAgICAgICB0aGlzLm9uTXV0YXRpb25zKG11dGF0aW9ucyk7XG4gICAgICB9KTtcbiAgICB9XG4gIH1cbiAgY29ubmVjdCgpIHtcbiAgICBpZiAodGhpcy5zZWxlY3RFbGVtZW50KSB7XG4gICAgICB0aGlzLm9yaWdpbmFsT3B0aW9ucyA9IHRoaXMuY3JlYXRlT3B0aW9uc0RhdGFTdHJ1Y3R1cmUodGhpcy5zZWxlY3RFbGVtZW50KTtcbiAgICB9XG4gICAgdGhpcy5pbml0aWFsaXplVG9tU2VsZWN0KCk7XG4gIH1cbiAgaW5pdGlhbGl6ZVRvbVNlbGVjdCgpIHtcbiAgICBpZiAodGhpcy5zZWxlY3RFbGVtZW50KSB7XG4gICAgICB0aGlzLnNlbGVjdEVsZW1lbnQuc2V0QXR0cmlidXRlKFwiZGF0YS1za2lwLW1vcnBoXCIsIFwiXCIpO1xuICAgIH1cbiAgICBpZiAodGhpcy51cmxWYWx1ZSkge1xuICAgICAgdGhpcy50b21TZWxlY3QgPSBfX3ByaXZhdGVNZXRob2QodGhpcywgX2luc3RhbmNlcywgY3JlYXRlQXV0b2NvbXBsZXRlV2l0aFJlbW90ZURhdGFfZm4pLmNhbGwodGhpcywgdGhpcy51cmxWYWx1ZSwgdGhpcy5oYXNNaW5DaGFyYWN0ZXJzVmFsdWUgPyB0aGlzLm1pbkNoYXJhY3RlcnNWYWx1ZSA6IG51bGwpO1xuICAgICAgcmV0dXJuO1xuICAgIH1cbiAgICBpZiAodGhpcy5vcHRpb25zQXNIdG1sVmFsdWUpIHtcbiAgICAgIHRoaXMudG9tU2VsZWN0ID0gX19wcml2YXRlTWV0aG9kKHRoaXMsIF9pbnN0YW5jZXMsIGNyZWF0ZUF1dG9jb21wbGV0ZVdpdGhIdG1sQ29udGVudHNfZm4pLmNhbGwodGhpcyk7XG4gICAgICByZXR1cm47XG4gICAgfVxuICAgIHRoaXMudG9tU2VsZWN0ID0gX19wcml2YXRlTWV0aG9kKHRoaXMsIF9pbnN0YW5jZXMsIGNyZWF0ZUF1dG9jb21wbGV0ZV9mbikuY2FsbCh0aGlzKTtcbiAgICB0aGlzLnN0YXJ0TXV0YXRpb25PYnNlcnZlcigpO1xuICB9XG4gIGRpc2Nvbm5lY3QoKSB7XG4gICAgdGhpcy5zdG9wTXV0YXRpb25PYnNlcnZlcigpO1xuICAgIGxldCBjdXJyZW50U2VsZWN0ZWRWYWx1ZXMgPSBbXTtcbiAgICBpZiAodGhpcy5zZWxlY3RFbGVtZW50KSB7XG4gICAgICBpZiAodGhpcy5zZWxlY3RFbGVtZW50Lm11bHRpcGxlKSB7XG4gICAgICAgIGN1cnJlbnRTZWxlY3RlZFZhbHVlcyA9IEFycmF5LmZyb20odGhpcy5zZWxlY3RFbGVtZW50Lm9wdGlvbnMpLmZpbHRlcigob3B0aW9uKSA9PiBvcHRpb24uc2VsZWN0ZWQpLm1hcCgob3B0aW9uKSA9PiBvcHRpb24udmFsdWUpO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgY3VycmVudFNlbGVjdGVkVmFsdWVzID0gW3RoaXMuc2VsZWN0RWxlbWVudC52YWx1ZV07XG4gICAgICB9XG4gICAgfVxuICAgIHRoaXMudG9tU2VsZWN0LmRlc3Ryb3koKTtcbiAgICBpZiAodGhpcy5zZWxlY3RFbGVtZW50KSB7XG4gICAgICBpZiAodGhpcy5zZWxlY3RFbGVtZW50Lm11bHRpcGxlKSB7XG4gICAgICAgIEFycmF5LmZyb20odGhpcy5zZWxlY3RFbGVtZW50Lm9wdGlvbnMpLmZvckVhY2goKG9wdGlvbikgPT4ge1xuICAgICAgICAgIG9wdGlvbi5zZWxlY3RlZCA9IGN1cnJlbnRTZWxlY3RlZFZhbHVlcy5pbmNsdWRlcyhvcHRpb24udmFsdWUpO1xuICAgICAgICB9KTtcbiAgICAgIH0gZWxzZSB7XG4gICAgICAgIHRoaXMuc2VsZWN0RWxlbWVudC52YWx1ZSA9IGN1cnJlbnRTZWxlY3RlZFZhbHVlc1swXTtcbiAgICAgIH1cbiAgICB9XG4gIH1cbiAgdXJsVmFsdWVDaGFuZ2VkKCkge1xuICAgIHRoaXMucmVzZXRUb21TZWxlY3QoKTtcbiAgfVxuICBnZXRNYXhPcHRpb25zKCkge1xuICAgIHJldHVybiB0aGlzLnNlbGVjdEVsZW1lbnQgPyB0aGlzLnNlbGVjdEVsZW1lbnQub3B0aW9ucy5sZW5ndGggOiA1MDtcbiAgfVxuICAvKipcbiAgICogUmV0dXJucyB0aGUgZWxlbWVudCwgYnV0IG9ubHkgaWYgaXQncyBhIHNlbGVjdCBlbGVtZW50LlxuICAgKi9cbiAgZ2V0IHNlbGVjdEVsZW1lbnQoKSB7XG4gICAgaWYgKCEodGhpcy5lbGVtZW50IGluc3RhbmNlb2YgSFRNTFNlbGVjdEVsZW1lbnQpKSB7XG4gICAgICByZXR1cm4gbnVsbDtcbiAgICB9XG4gICAgcmV0dXJuIHRoaXMuZWxlbWVudDtcbiAgfVxuICAvKipcbiAgICogR2V0dGVyIHRvIGhlbHAgdHlwaW5nLlxuICAgKi9cbiAgZ2V0IGZvcm1FbGVtZW50KCkge1xuICAgIGlmICghKHRoaXMuZWxlbWVudCBpbnN0YW5jZW9mIEhUTUxJbnB1dEVsZW1lbnQpICYmICEodGhpcy5lbGVtZW50IGluc3RhbmNlb2YgSFRNTFNlbGVjdEVsZW1lbnQpKSB7XG4gICAgICB0aHJvdyBuZXcgRXJyb3IoXCJBdXRvY29tcGxldGUgU3RpbXVsdXMgY29udHJvbGxlciBjYW4gb25seSBiZSB1c2VkIG9uIGFuIDxpbnB1dD4gb3IgPHNlbGVjdD4uXCIpO1xuICAgIH1cbiAgICByZXR1cm4gdGhpcy5lbGVtZW50O1xuICB9XG4gIGRpc3BhdGNoRXZlbnQobmFtZSwgcGF5bG9hZCkge1xuICAgIHRoaXMuZGlzcGF0Y2gobmFtZSwgeyBkZXRhaWw6IHBheWxvYWQsIHByZWZpeDogXCJhdXRvY29tcGxldGVcIiB9KTtcbiAgfVxuICBnZXQgcHJlbG9hZCgpIHtcbiAgICBpZiAoIXRoaXMuaGFzUHJlbG9hZFZhbHVlKSB7XG4gICAgICByZXR1cm4gXCJmb2N1c1wiO1xuICAgIH1cbiAgICBpZiAodGhpcy5wcmVsb2FkVmFsdWUgPT09IFwiZmFsc2VcIikge1xuICAgICAgcmV0dXJuIGZhbHNlO1xuICAgIH1cbiAgICBpZiAodGhpcy5wcmVsb2FkVmFsdWUgPT09IFwidHJ1ZVwiKSB7XG4gICAgICByZXR1cm4gdHJ1ZTtcbiAgICB9XG4gICAgcmV0dXJuIHRoaXMucHJlbG9hZFZhbHVlO1xuICB9XG4gIHJlc2V0VG9tU2VsZWN0KCkge1xuICAgIGlmICh0aGlzLnRvbVNlbGVjdCkge1xuICAgICAgdGhpcy5kaXNwYXRjaEV2ZW50KFwiYmVmb3JlLXJlc2V0XCIsIHsgdG9tU2VsZWN0OiB0aGlzLnRvbVNlbGVjdCB9KTtcbiAgICAgIHRoaXMuc3RvcE11dGF0aW9uT2JzZXJ2ZXIoKTtcbiAgICAgIGNvbnN0IGN1cnJlbnRIdG1sID0gdGhpcy5lbGVtZW50LmlubmVySFRNTDtcbiAgICAgIGNvbnN0IGN1cnJlbnRWYWx1ZSA9IHRoaXMudG9tU2VsZWN0LmdldFZhbHVlKCk7XG4gICAgICB0aGlzLnRvbVNlbGVjdC5kZXN0cm95KCk7XG4gICAgICB0aGlzLmVsZW1lbnQuaW5uZXJIVE1MID0gY3VycmVudEh0bWw7XG4gICAgICB0aGlzLmluaXRpYWxpemVUb21TZWxlY3QoKTtcbiAgICAgIHRoaXMudG9tU2VsZWN0LnNldFZhbHVlKGN1cnJlbnRWYWx1ZSk7XG4gICAgfVxuICB9XG4gIGNoYW5nZVRvbVNlbGVjdERpc2FibGVkU3RhdGUoaXNEaXNhYmxlZCkge1xuICAgIHRoaXMuc3RvcE11dGF0aW9uT2JzZXJ2ZXIoKTtcbiAgICBpZiAoaXNEaXNhYmxlZCkge1xuICAgICAgdGhpcy50b21TZWxlY3QuZGlzYWJsZSgpO1xuICAgIH0gZWxzZSB7XG4gICAgICB0aGlzLnRvbVNlbGVjdC5lbmFibGUoKTtcbiAgICB9XG4gICAgdGhpcy5zdGFydE11dGF0aW9uT2JzZXJ2ZXIoKTtcbiAgfVxuICBzdGFydE11dGF0aW9uT2JzZXJ2ZXIoKSB7XG4gICAgaWYgKCF0aGlzLmlzT2JzZXJ2aW5nICYmIHRoaXMubXV0YXRpb25PYnNlcnZlcikge1xuICAgICAgdGhpcy5tdXRhdGlvbk9ic2VydmVyLm9ic2VydmUodGhpcy5lbGVtZW50LCB7XG4gICAgICAgIGNoaWxkTGlzdDogdHJ1ZSxcbiAgICAgICAgc3VidHJlZTogdHJ1ZSxcbiAgICAgICAgYXR0cmlidXRlczogdHJ1ZSxcbiAgICAgICAgY2hhcmFjdGVyRGF0YTogdHJ1ZSxcbiAgICAgICAgYXR0cmlidXRlT2xkVmFsdWU6IHRydWVcbiAgICAgIH0pO1xuICAgICAgdGhpcy5pc09ic2VydmluZyA9IHRydWU7XG4gICAgfVxuICB9XG4gIHN0b3BNdXRhdGlvbk9ic2VydmVyKCkge1xuICAgIGlmICh0aGlzLmlzT2JzZXJ2aW5nICYmIHRoaXMubXV0YXRpb25PYnNlcnZlcikge1xuICAgICAgdGhpcy5tdXRhdGlvbk9ic2VydmVyLmRpc2Nvbm5lY3QoKTtcbiAgICAgIHRoaXMuaXNPYnNlcnZpbmcgPSBmYWxzZTtcbiAgICB9XG4gIH1cbiAgb25NdXRhdGlvbnMobXV0YXRpb25zKSB7XG4gICAgbGV0IGNoYW5nZURpc2FibGVkU3RhdGUgPSBmYWxzZTtcbiAgICBsZXQgcmVxdWlyZVJlc2V0ID0gZmFsc2U7XG4gICAgbXV0YXRpb25zLmZvckVhY2goKG11dGF0aW9uKSA9PiB7XG4gICAgICBzd2l0Y2ggKG11dGF0aW9uLnR5cGUpIHtcbiAgICAgICAgY2FzZSBcImF0dHJpYnV0ZXNcIjpcbiAgICAgICAgICBpZiAobXV0YXRpb24udGFyZ2V0ID09PSB0aGlzLmVsZW1lbnQgJiYgbXV0YXRpb24uYXR0cmlidXRlTmFtZSA9PT0gXCJkaXNhYmxlZFwiKSB7XG4gICAgICAgICAgICBjaGFuZ2VEaXNhYmxlZFN0YXRlID0gdHJ1ZTtcbiAgICAgICAgICAgIGJyZWFrO1xuICAgICAgICAgIH1cbiAgICAgICAgICBpZiAobXV0YXRpb24udGFyZ2V0ID09PSB0aGlzLmVsZW1lbnQgJiYgbXV0YXRpb24uYXR0cmlidXRlTmFtZSA9PT0gXCJtdWx0aXBsZVwiKSB7XG4gICAgICAgICAgICBjb25zdCBpc05vd011bHRpcGxlID0gdGhpcy5lbGVtZW50Lmhhc0F0dHJpYnV0ZShcIm11bHRpcGxlXCIpO1xuICAgICAgICAgICAgY29uc3Qgd2FzTXVsdGlwbGUgPSBtdXRhdGlvbi5vbGRWYWx1ZSA9PT0gXCJtdWx0aXBsZVwiO1xuICAgICAgICAgICAgaWYgKGlzTm93TXVsdGlwbGUgIT09IHdhc011bHRpcGxlKSB7XG4gICAgICAgICAgICAgIHJlcXVpcmVSZXNldCA9IHRydWU7XG4gICAgICAgICAgICB9XG4gICAgICAgICAgICBicmVhaztcbiAgICAgICAgICB9XG4gICAgICAgICAgYnJlYWs7XG4gICAgICB9XG4gICAgfSk7XG4gICAgY29uc3QgbmV3T3B0aW9ucyA9IHRoaXMuc2VsZWN0RWxlbWVudCA/IHRoaXMuY3JlYXRlT3B0aW9uc0RhdGFTdHJ1Y3R1cmUodGhpcy5zZWxlY3RFbGVtZW50KSA6IFtdO1xuICAgIGNvbnN0IGFyZU9wdGlvbnNFcXVpdmFsZW50ID0gdGhpcy5hcmVPcHRpb25zRXF1aXZhbGVudChuZXdPcHRpb25zKTtcbiAgICBpZiAoIWFyZU9wdGlvbnNFcXVpdmFsZW50IHx8IHJlcXVpcmVSZXNldCkge1xuICAgICAgdGhpcy5vcmlnaW5hbE9wdGlvbnMgPSBuZXdPcHRpb25zO1xuICAgICAgdGhpcy5yZXNldFRvbVNlbGVjdCgpO1xuICAgIH1cbiAgICBpZiAoY2hhbmdlRGlzYWJsZWRTdGF0ZSkge1xuICAgICAgdGhpcy5jaGFuZ2VUb21TZWxlY3REaXNhYmxlZFN0YXRlKHRoaXMuZm9ybUVsZW1lbnQuZGlzYWJsZWQpO1xuICAgIH1cbiAgfVxuICBjcmVhdGVPcHRpb25zRGF0YVN0cnVjdHVyZShzZWxlY3RFbGVtZW50KSB7XG4gICAgcmV0dXJuIEFycmF5LmZyb20oc2VsZWN0RWxlbWVudC5vcHRpb25zKS5tYXAoKG9wdGlvbikgPT4ge1xuICAgICAgcmV0dXJuIHtcbiAgICAgICAgdmFsdWU6IG9wdGlvbi52YWx1ZSxcbiAgICAgICAgdGV4dDogb3B0aW9uLnRleHRcbiAgICAgIH07XG4gICAgfSk7XG4gIH1cbiAgYXJlT3B0aW9uc0VxdWl2YWxlbnQobmV3T3B0aW9ucykge1xuICAgIGNvbnN0IGZpbHRlcmVkT3JpZ2luYWxPcHRpb25zID0gdGhpcy5vcmlnaW5hbE9wdGlvbnMuZmlsdGVyKChvcHRpb24pID0+IG9wdGlvbi52YWx1ZSAhPT0gXCJcIik7XG4gICAgY29uc3QgZmlsdGVyZWROZXdPcHRpb25zID0gbmV3T3B0aW9ucy5maWx0ZXIoKG9wdGlvbikgPT4gb3B0aW9uLnZhbHVlICE9PSBcIlwiKTtcbiAgICBjb25zdCBvcmlnaW5hbFBsYWNlaG9sZGVyT3B0aW9uID0gdGhpcy5vcmlnaW5hbE9wdGlvbnMuZmluZCgob3B0aW9uKSA9PiBvcHRpb24udmFsdWUgPT09IFwiXCIpO1xuICAgIGNvbnN0IG5ld1BsYWNlaG9sZGVyT3B0aW9uID0gbmV3T3B0aW9ucy5maW5kKChvcHRpb24pID0+IG9wdGlvbi52YWx1ZSA9PT0gXCJcIik7XG4gICAgaWYgKG9yaWdpbmFsUGxhY2Vob2xkZXJPcHRpb24gJiYgbmV3UGxhY2Vob2xkZXJPcHRpb24gJiYgb3JpZ2luYWxQbGFjZWhvbGRlck9wdGlvbi50ZXh0ICE9PSBuZXdQbGFjZWhvbGRlck9wdGlvbi50ZXh0KSB7XG4gICAgICByZXR1cm4gZmFsc2U7XG4gICAgfVxuICAgIGlmIChmaWx0ZXJlZE9yaWdpbmFsT3B0aW9ucy5sZW5ndGggIT09IGZpbHRlcmVkTmV3T3B0aW9ucy5sZW5ndGgpIHtcbiAgICAgIHJldHVybiBmYWxzZTtcbiAgICB9XG4gICAgY29uc3Qgbm9ybWFsaXplT3B0aW9uID0gKG9wdGlvbikgPT4gYCR7b3B0aW9uLnZhbHVlfS0ke29wdGlvbi50ZXh0fWA7XG4gICAgY29uc3Qgb3JpZ2luYWxPcHRpb25zU2V0ID0gbmV3IFNldChmaWx0ZXJlZE9yaWdpbmFsT3B0aW9ucy5tYXAobm9ybWFsaXplT3B0aW9uKSk7XG4gICAgY29uc3QgbmV3T3B0aW9uc1NldCA9IG5ldyBTZXQoZmlsdGVyZWROZXdPcHRpb25zLm1hcChub3JtYWxpemVPcHRpb24pKTtcbiAgICByZXR1cm4gb3JpZ2luYWxPcHRpb25zU2V0LnNpemUgPT09IG5ld09wdGlvbnNTZXQuc2l6ZSAmJiBbLi4ub3JpZ2luYWxPcHRpb25zU2V0XS5ldmVyeSgob3B0aW9uKSA9PiBuZXdPcHRpb25zU2V0LmhhcyhvcHRpb24pKTtcbiAgfVxufTtcbl9pbnN0YW5jZXMgPSBuZXcgV2Vha1NldCgpO1xuZ2V0Q29tbW9uQ29uZmlnX2ZuID0gZnVuY3Rpb24oKSB7XG4gIGNvbnN0IHBsdWdpbnMgPSB7fTtcbiAgY29uc3QgaXNNdWx0aXBsZSA9ICF0aGlzLnNlbGVjdEVsZW1lbnQgfHwgdGhpcy5zZWxlY3RFbGVtZW50Lm11bHRpcGxlO1xuICBpZiAoIXRoaXMuZm9ybUVsZW1lbnQuZGlzYWJsZWQgJiYgIWlzTXVsdGlwbGUpIHtcbiAgICBwbHVnaW5zLmNsZWFyX2J1dHRvbiA9IHsgdGl0bGU6IFwiXCIgfTtcbiAgfVxuICBpZiAoaXNNdWx0aXBsZSkge1xuICAgIHBsdWdpbnMucmVtb3ZlX2J1dHRvbiA9IHsgdGl0bGU6IFwiXCIgfTtcbiAgfVxuICBpZiAodGhpcy51cmxWYWx1ZSkge1xuICAgIHBsdWdpbnMudmlydHVhbF9zY3JvbGwgPSB7fTtcbiAgfVxuICBjb25zdCByZW5kZXIgPSB7XG4gICAgbm9fcmVzdWx0czogKCkgPT4ge1xuICAgICAgcmV0dXJuIGA8ZGl2IGNsYXNzPVwibm8tcmVzdWx0c1wiPiR7dGhpcy5ub1Jlc3VsdHNGb3VuZFRleHRWYWx1ZX08L2Rpdj5gO1xuICAgIH0sXG4gICAgb3B0aW9uX2NyZWF0ZTogKGRhdGEsIGVzY2FwZURhdGEpID0+IHtcbiAgICAgIHJldHVybiBgPGRpdiBjbGFzcz1cImNyZWF0ZVwiPiR7dGhpcy5jcmVhdGVPcHRpb25UZXh0VmFsdWUucmVwbGFjZShcIiVwbGFjZWhvbGRlciVcIiwgYDxzdHJvbmc+JHtlc2NhcGVEYXRhKGRhdGEuaW5wdXQpfTwvc3Ryb25nPmApfTwvZGl2PmA7XG4gICAgfVxuICB9O1xuICBjb25zdCBjb25maWcgPSB7XG4gICAgcmVuZGVyLFxuICAgIHBsdWdpbnMsXG4gICAgLy8gY2xlYXIgdGhlIHRleHQgaW5wdXQgYWZ0ZXIgc2VsZWN0aW5nIGEgdmFsdWVcbiAgICBvbkl0ZW1BZGQ6ICgpID0+IHtcbiAgICAgIHRoaXMudG9tU2VsZWN0LnNldFRleHRib3hWYWx1ZShcIlwiKTtcbiAgICB9LFxuICAgIGNsb3NlQWZ0ZXJTZWxlY3Q6IHRydWUsXG4gICAgLy8gZml4IHBvc2l0aW9uaW5nIChpbiB0aGUgZHJvcGRvd24pIG9mIG9wdGlvbnMgYWRkZWQgdGhyb3VnaCBhZGRPcHRpb24oKVxuICAgIG9uT3B0aW9uQWRkOiAodmFsdWUsIGRhdGEpID0+IHtcbiAgICAgIGxldCBwYXJlbnRFbGVtZW50ID0gdGhpcy50b21TZWxlY3QuaW5wdXQ7XG4gICAgICBsZXQgb3B0Z3JvdXBEYXRhID0gbnVsbDtcbiAgICAgIGNvbnN0IG9wdGdyb3VwID0gZGF0YVt0aGlzLnRvbVNlbGVjdC5zZXR0aW5ncy5vcHRncm91cEZpZWxkXTtcbiAgICAgIGlmIChvcHRncm91cCAmJiB0aGlzLnRvbVNlbGVjdC5vcHRncm91cHMpIHtcbiAgICAgICAgb3B0Z3JvdXBEYXRhID0gdGhpcy50b21TZWxlY3Qub3B0Z3JvdXBzW29wdGdyb3VwXTtcbiAgICAgICAgaWYgKG9wdGdyb3VwRGF0YSkge1xuICAgICAgICAgIGNvbnN0IG9wdGdyb3VwRWxlbWVudCA9IHBhcmVudEVsZW1lbnQucXVlcnlTZWxlY3Rvcihgb3B0Z3JvdXBbbGFiZWw9XCIke29wdGdyb3VwRGF0YS5sYWJlbH1cIl1gKTtcbiAgICAgICAgICBpZiAob3B0Z3JvdXBFbGVtZW50KSB7XG4gICAgICAgICAgICBwYXJlbnRFbGVtZW50ID0gb3B0Z3JvdXBFbGVtZW50O1xuICAgICAgICAgIH1cbiAgICAgICAgfVxuICAgICAgfVxuICAgICAgY29uc3Qgb3B0aW9uRWxlbWVudCA9IGRvY3VtZW50LmNyZWF0ZUVsZW1lbnQoXCJvcHRpb25cIik7XG4gICAgICBvcHRpb25FbGVtZW50LnZhbHVlID0gdmFsdWU7XG4gICAgICBvcHRpb25FbGVtZW50LnRleHQgPSBkYXRhW3RoaXMudG9tU2VsZWN0LnNldHRpbmdzLmxhYmVsRmllbGRdO1xuICAgICAgY29uc3Qgb3B0aW9uT3JkZXIgPSBkYXRhLiRvcmRlcjtcbiAgICAgIGxldCBvcmRlcmVkT3B0aW9uID0gbnVsbDtcbiAgICAgIGZvciAoY29uc3QgWywgdG9tU2VsZWN0T3B0aW9uXSBvZiBPYmplY3QuZW50cmllcyh0aGlzLnRvbVNlbGVjdC5vcHRpb25zKSkge1xuICAgICAgICBpZiAodG9tU2VsZWN0T3B0aW9uLiRvcmRlciA9PT0gb3B0aW9uT3JkZXIpIHtcbiAgICAgICAgICBvcmRlcmVkT3B0aW9uID0gcGFyZW50RWxlbWVudC5xdWVyeVNlbGVjdG9yKFxuICAgICAgICAgICAgYDpzY29wZSA+IG9wdGlvblt2YWx1ZT1cIiR7Q1NTLmVzY2FwZSh0b21TZWxlY3RPcHRpb25bdGhpcy50b21TZWxlY3Quc2V0dGluZ3MudmFsdWVGaWVsZF0pfVwiXWBcbiAgICAgICAgICApO1xuICAgICAgICAgIGJyZWFrO1xuICAgICAgICB9XG4gICAgICB9XG4gICAgICBpZiAob3JkZXJlZE9wdGlvbikge1xuICAgICAgICBvcmRlcmVkT3B0aW9uLmluc2VydEFkamFjZW50RWxlbWVudChcImFmdGVyZW5kXCIsIG9wdGlvbkVsZW1lbnQpO1xuICAgICAgfSBlbHNlIGlmIChvcHRpb25PcmRlciA+PSAwKSB7XG4gICAgICAgIHBhcmVudEVsZW1lbnQuYXBwZW5kKG9wdGlvbkVsZW1lbnQpO1xuICAgICAgfSBlbHNlIHtcbiAgICAgICAgcGFyZW50RWxlbWVudC5wcmVwZW5kKG9wdGlvbkVsZW1lbnQpO1xuICAgICAgfVxuICAgIH1cbiAgfTtcbiAgaWYgKCF0aGlzLnNlbGVjdEVsZW1lbnQgJiYgIXRoaXMudXJsVmFsdWUpIHtcbiAgICBjb25maWcuc2hvdWxkTG9hZCA9ICgpID0+IGZhbHNlO1xuICB9XG4gIHJldHVybiBfX3ByaXZhdGVNZXRob2QodGhpcywgX2luc3RhbmNlcywgbWVyZ2VDb25maWdzX2ZuKS5jYWxsKHRoaXMsIGNvbmZpZywgdGhpcy50b21TZWxlY3RPcHRpb25zVmFsdWUpO1xufTtcbmNyZWF0ZUF1dG9jb21wbGV0ZV9mbiA9IGZ1bmN0aW9uKCkge1xuICBjb25zdCBjb25maWcgPSBfX3ByaXZhdGVNZXRob2QodGhpcywgX2luc3RhbmNlcywgbWVyZ2VDb25maWdzX2ZuKS5jYWxsKHRoaXMsIF9fcHJpdmF0ZU1ldGhvZCh0aGlzLCBfaW5zdGFuY2VzLCBnZXRDb21tb25Db25maWdfZm4pLmNhbGwodGhpcyksIHtcbiAgICBtYXhPcHRpb25zOiB0aGlzLmdldE1heE9wdGlvbnMoKVxuICB9KTtcbiAgcmV0dXJuIF9fcHJpdmF0ZU1ldGhvZCh0aGlzLCBfaW5zdGFuY2VzLCBjcmVhdGVUb21TZWxlY3RfZm4pLmNhbGwodGhpcywgY29uZmlnKTtcbn07XG5jcmVhdGVBdXRvY29tcGxldGVXaXRoSHRtbENvbnRlbnRzX2ZuID0gZnVuY3Rpb24oKSB7XG4gIGNvbnN0IGNvbW1vbkNvbmZpZyA9IF9fcHJpdmF0ZU1ldGhvZCh0aGlzLCBfaW5zdGFuY2VzLCBnZXRDb21tb25Db25maWdfZm4pLmNhbGwodGhpcyk7XG4gIGNvbnN0IGxhYmVsRmllbGQgPSBjb21tb25Db25maWcubGFiZWxGaWVsZCA/PyBcInRleHRcIjtcbiAgY29uc3QgY29uZmlnID0gX19wcml2YXRlTWV0aG9kKHRoaXMsIF9pbnN0YW5jZXMsIG1lcmdlQ29uZmlnc19mbikuY2FsbCh0aGlzLCBjb21tb25Db25maWcsIHtcbiAgICBtYXhPcHRpb25zOiB0aGlzLmdldE1heE9wdGlvbnMoKSxcbiAgICBzY29yZTogKHNlYXJjaCkgPT4ge1xuICAgICAgY29uc3Qgc2NvcmluZ0Z1bmN0aW9uID0gdGhpcy50b21TZWxlY3QuZ2V0U2NvcmVGdW5jdGlvbihzZWFyY2gpO1xuICAgICAgcmV0dXJuIChpdGVtKSA9PiB7XG4gICAgICAgIHJldHVybiBzY29yaW5nRnVuY3Rpb24oeyAuLi5pdGVtLCB0ZXh0OiBfX3ByaXZhdGVNZXRob2QodGhpcywgX2luc3RhbmNlcywgc3RyaXBUYWdzX2ZuKS5jYWxsKHRoaXMsIGl0ZW1bbGFiZWxGaWVsZF0pIH0pO1xuICAgICAgfTtcbiAgICB9LFxuICAgIHJlbmRlcjoge1xuICAgICAgaXRlbTogKGl0ZW0pID0+IGA8ZGl2PiR7aXRlbVtsYWJlbEZpZWxkXX08L2Rpdj5gLFxuICAgICAgb3B0aW9uOiAoaXRlbSkgPT4gYDxkaXY+JHtpdGVtW2xhYmVsRmllbGRdfTwvZGl2PmBcbiAgICB9XG4gIH0pO1xuICByZXR1cm4gX19wcml2YXRlTWV0aG9kKHRoaXMsIF9pbnN0YW5jZXMsIGNyZWF0ZVRvbVNlbGVjdF9mbikuY2FsbCh0aGlzLCBjb25maWcpO1xufTtcbmNyZWF0ZUF1dG9jb21wbGV0ZVdpdGhSZW1vdGVEYXRhX2ZuID0gZnVuY3Rpb24oYXV0b2NvbXBsZXRlRW5kcG9pbnRVcmwsIG1pbkNoYXJhY3Rlckxlbmd0aCkge1xuICBjb25zdCBjb21tb25Db25maWcgPSBfX3ByaXZhdGVNZXRob2QodGhpcywgX2luc3RhbmNlcywgZ2V0Q29tbW9uQ29uZmlnX2ZuKS5jYWxsKHRoaXMpO1xuICBjb25zdCBsYWJlbEZpZWxkID0gY29tbW9uQ29uZmlnLmxhYmVsRmllbGQgPz8gXCJ0ZXh0XCI7XG4gIGNvbnN0IGNvbmZpZyA9IF9fcHJpdmF0ZU1ldGhvZCh0aGlzLCBfaW5zdGFuY2VzLCBtZXJnZUNvbmZpZ3NfZm4pLmNhbGwodGhpcywgY29tbW9uQ29uZmlnLCB7XG4gICAgZmlyc3RVcmw6IChxdWVyeSkgPT4ge1xuICAgICAgY29uc3Qgc2VwYXJhdG9yID0gYXV0b2NvbXBsZXRlRW5kcG9pbnRVcmwuaW5jbHVkZXMoXCI/XCIpID8gXCImXCIgOiBcIj9cIjtcbiAgICAgIHJldHVybiBgJHthdXRvY29tcGxldGVFbmRwb2ludFVybH0ke3NlcGFyYXRvcn1xdWVyeT0ke2VuY29kZVVSSUNvbXBvbmVudChxdWVyeSl9YDtcbiAgICB9LFxuICAgIC8vIFZFUlkgSU1QT1JUQU5UOiB1c2UgJ2Z1bmN0aW9uIChxdWVyeSwgY2FsbGJhY2spIHsgLi4uIH0nIGluc3RlYWQgb2YgdGhlXG4gICAgLy8gJyhxdWVyeSwgY2FsbGJhY2spID0+IHsgLi4uIH0nIHN5bnRheCBiZWNhdXNlLCBvdGhlcndpc2UsXG4gICAgLy8gdGhlICd0aGlzLlhYWCcgY2FsbHMgaW5zaWRlIHRoaXMgbWV0aG9kIGZhaWxcbiAgICBsb2FkOiBmdW5jdGlvbihxdWVyeSwgY2FsbGJhY2spIHtcbiAgICAgIGNvbnN0IHVybCA9IHRoaXMuZ2V0VXJsKHF1ZXJ5KTtcbiAgICAgIGZldGNoKHVybCkudGhlbigocmVzcG9uc2UpID0+IHJlc3BvbnNlLmpzb24oKSkudGhlbigoanNvbikgPT4ge1xuICAgICAgICB0aGlzLnNldE5leHRVcmwocXVlcnksIGpzb24ubmV4dF9wYWdlKTtcbiAgICAgICAgY2FsbGJhY2soanNvbi5yZXN1bHRzLm9wdGlvbnMgfHwganNvbi5yZXN1bHRzLCBqc29uLnJlc3VsdHMub3B0Z3JvdXBzIHx8IFtdKTtcbiAgICAgIH0pLmNhdGNoKCgpID0+IGNhbGxiYWNrKFtdLCBbXSkpO1xuICAgIH0sXG4gICAgc2hvdWxkTG9hZDogKHF1ZXJ5KSA9PiB7XG4gICAgICBpZiAobnVsbCAhPT0gbWluQ2hhcmFjdGVyTGVuZ3RoKSB7XG4gICAgICAgIHJldHVybiBxdWVyeS5sZW5ndGggPj0gbWluQ2hhcmFjdGVyTGVuZ3RoO1xuICAgICAgfVxuICAgICAgaWYgKHRoaXMuaGFzTG9hZGVkQ2hvaWNlc1ByZXZpb3VzbHkpIHtcbiAgICAgICAgcmV0dXJuIHRydWU7XG4gICAgICB9XG4gICAgICBpZiAocXVlcnkubGVuZ3RoID4gMCkge1xuICAgICAgICB0aGlzLmhhc0xvYWRlZENob2ljZXNQcmV2aW91c2x5ID0gdHJ1ZTtcbiAgICAgIH1cbiAgICAgIHJldHVybiBxdWVyeS5sZW5ndGggPj0gMztcbiAgICB9LFxuICAgIG9wdGdyb3VwRmllbGQ6IFwiZ3JvdXBfYnlcIixcbiAgICAvLyBhdm9pZCBleHRyYSBmaWx0ZXJpbmcgYWZ0ZXIgcmVzdWx0cyBhcmUgcmV0dXJuZWRcbiAgICBzY29yZTogKHNlYXJjaCkgPT4gKGl0ZW0pID0+IDEsXG4gICAgcmVuZGVyOiB7XG4gICAgICBvcHRpb246IChpdGVtKSA9PiBgPGRpdj4ke2l0ZW1bbGFiZWxGaWVsZF19PC9kaXY+YCxcbiAgICAgIGl0ZW06IChpdGVtKSA9PiBgPGRpdj4ke2l0ZW1bbGFiZWxGaWVsZF19PC9kaXY+YCxcbiAgICAgIGxvYWRpbmdfbW9yZTogKCkgPT4ge1xuICAgICAgICByZXR1cm4gYDxkaXYgY2xhc3M9XCJsb2FkaW5nLW1vcmUtcmVzdWx0c1wiPiR7dGhpcy5sb2FkaW5nTW9yZVRleHRWYWx1ZX08L2Rpdj5gO1xuICAgICAgfSxcbiAgICAgIG5vX21vcmVfcmVzdWx0czogKCkgPT4ge1xuICAgICAgICByZXR1cm4gYDxkaXYgY2xhc3M9XCJuby1tb3JlLXJlc3VsdHNcIj4ke3RoaXMubm9Nb3JlUmVzdWx0c1RleHRWYWx1ZX08L2Rpdj5gO1xuICAgICAgfSxcbiAgICAgIG5vX3Jlc3VsdHM6ICgpID0+IHtcbiAgICAgICAgcmV0dXJuIGA8ZGl2IGNsYXNzPVwibm8tcmVzdWx0c1wiPiR7dGhpcy5ub1Jlc3VsdHNGb3VuZFRleHRWYWx1ZX08L2Rpdj5gO1xuICAgICAgfSxcbiAgICAgIG9wdGlvbl9jcmVhdGU6IChkYXRhLCBlc2NhcGVEYXRhKSA9PiB7XG4gICAgICAgIHJldHVybiBgPGRpdiBjbGFzcz1cImNyZWF0ZVwiPiR7dGhpcy5jcmVhdGVPcHRpb25UZXh0VmFsdWUucmVwbGFjZShcIiVwbGFjZWhvbGRlciVcIiwgYDxzdHJvbmc+JHtlc2NhcGVEYXRhKGRhdGEuaW5wdXQpfTwvc3Ryb25nPmApfTwvZGl2PmA7XG4gICAgICB9XG4gICAgfSxcbiAgICBwcmVsb2FkOiB0aGlzLnByZWxvYWRcbiAgfSk7XG4gIHJldHVybiBfX3ByaXZhdGVNZXRob2QodGhpcywgX2luc3RhbmNlcywgY3JlYXRlVG9tU2VsZWN0X2ZuKS5jYWxsKHRoaXMsIGNvbmZpZyk7XG59O1xuc3RyaXBUYWdzX2ZuID0gZnVuY3Rpb24oc3RyaW5nKSB7XG4gIHJldHVybiBzdHJpbmcucmVwbGFjZSgvKDwoW14+XSspPikvZ2ksIFwiXCIpO1xufTtcbm1lcmdlQ29uZmlnc19mbiA9IGZ1bmN0aW9uKGNvbmZpZzEsIGNvbmZpZzIpIHtcbiAgcmV0dXJuIHtcbiAgICAuLi5jb25maWcxLFxuICAgIC4uLmNvbmZpZzIsXG4gICAgLy8gUGx1Z2lucyBmcm9tIGJvdGggY29uZmlncyBzaG91bGQgYmUgbWVyZ2VkIHRvZ2V0aGVyLlxuICAgIHBsdWdpbnM6IF9fcHJpdmF0ZU1ldGhvZCh0aGlzLCBfaW5zdGFuY2VzLCBub3JtYWxpemVQbHVnaW5zX2ZuKS5jYWxsKHRoaXMsIHtcbiAgICAgIC4uLl9fcHJpdmF0ZUdldCh0aGlzLCBfbm9ybWFsaXplUGx1Z2luc1RvSGFzaCkuY2FsbCh0aGlzLCBjb25maWcxLnBsdWdpbnMgfHwge30pLFxuICAgICAgLi4uX19wcml2YXRlR2V0KHRoaXMsIF9ub3JtYWxpemVQbHVnaW5zVG9IYXNoKS5jYWxsKHRoaXMsIGNvbmZpZzIucGx1Z2lucyB8fCB7fSlcbiAgICB9KVxuICB9O1xufTtcbl9ub3JtYWxpemVQbHVnaW5zVG9IYXNoID0gbmV3IFdlYWtNYXAoKTtcbm5vcm1hbGl6ZVBsdWdpbnNfZm4gPSBmdW5jdGlvbihwbHVnaW5zKSB7XG4gIHJldHVybiBPYmplY3QuZW50cmllcyhwbHVnaW5zKS5yZWR1Y2UoKGFjYywgW3BsdWdpbk5hbWUsIHBsdWdpbk9wdGlvbnNdKSA9PiB7XG4gICAgaWYgKHBsdWdpbk9wdGlvbnMgIT09IGZhbHNlKSB7XG4gICAgICBhY2NbcGx1Z2luTmFtZV0gPSBwbHVnaW5PcHRpb25zO1xuICAgIH1cbiAgICByZXR1cm4gYWNjO1xuICB9LCB7fSk7XG59O1xuY3JlYXRlVG9tU2VsZWN0X2ZuID0gZnVuY3Rpb24ob3B0aW9ucykge1xuICBjb25zdCBwcmVDb25uZWN0UGF5bG9hZCA9IHsgb3B0aW9ucyB9O1xuICB0aGlzLmRpc3BhdGNoRXZlbnQoXCJwcmUtY29ubmVjdFwiLCBwcmVDb25uZWN0UGF5bG9hZCk7XG4gIGNvbnN0IHRvbVNlbGVjdCA9IG5ldyBUb21TZWxlY3QodGhpcy5mb3JtRWxlbWVudCwgb3B0aW9ucyk7XG4gIGNvbnN0IGNvbm5lY3RQYXlsb2FkID0geyB0b21TZWxlY3QsIG9wdGlvbnMgfTtcbiAgdGhpcy5kaXNwYXRjaEV2ZW50KFwiY29ubmVjdFwiLCBjb25uZWN0UGF5bG9hZCk7XG4gIHJldHVybiB0b21TZWxlY3Q7XG59O1xuY29udHJvbGxlcl9kZWZhdWx0LnZhbHVlcyA9IHtcbiAgdXJsOiBTdHJpbmcsXG4gIG9wdGlvbnNBc0h0bWw6IEJvb2xlYW4sXG4gIGxvYWRpbmdNb3JlVGV4dDogU3RyaW5nLFxuICBub1Jlc3VsdHNGb3VuZFRleHQ6IFN0cmluZyxcbiAgbm9Nb3JlUmVzdWx0c1RleHQ6IFN0cmluZyxcbiAgY3JlYXRlT3B0aW9uVGV4dDogU3RyaW5nLFxuICBtaW5DaGFyYWN0ZXJzOiBOdW1iZXIsXG4gIHRvbVNlbGVjdE9wdGlvbnM6IE9iamVjdCxcbiAgcHJlbG9hZDogU3RyaW5nXG59O1xuZXhwb3J0IHtcbiAgY29udHJvbGxlcl9kZWZhdWx0IGFzIGRlZmF1bHRcbn07XG4iXSwibmFtZXMiOlsic3RhcnRTdGltdWx1c0FwcCIsImFwcCIsInJlcXVpcmUiLCJjb250ZXh0IiwiQ29udHJvbGxlciIsIl9kZWZhdWx0IiwiX0NvbnRyb2xsZXIiLCJfY2xhc3NDYWxsQ2hlY2siLCJfY2FsbFN1cGVyIiwiYXJndW1lbnRzIiwiX2luaGVyaXRzIiwiX2NyZWF0ZUNsYXNzIiwia2V5IiwidmFsdWUiLCJjb25uZWN0IiwiZWxlbWVudCIsInRleHRDb250ZW50IiwiZGVmYXVsdCIsIl9fdHlwZUVycm9yIiwibXNnIiwiVHlwZUVycm9yIiwiX19hY2Nlc3NDaGVjayIsIm9iaiIsIm1lbWJlciIsImhhcyIsIl9fcHJpdmF0ZUdldCIsImdldHRlciIsImNhbGwiLCJnZXQiLCJfX3ByaXZhdGVBZGQiLCJXZWFrU2V0IiwiYWRkIiwic2V0IiwiX19wcml2YXRlTWV0aG9kIiwibWV0aG9kIiwiVG9tU2VsZWN0IiwiX2luc3RhbmNlcyIsImdldENvbW1vbkNvbmZpZ19mbiIsImNyZWF0ZUF1dG9jb21wbGV0ZV9mbiIsImNyZWF0ZUF1dG9jb21wbGV0ZVdpdGhIdG1sQ29udGVudHNfZm4iLCJjcmVhdGVBdXRvY29tcGxldGVXaXRoUmVtb3RlRGF0YV9mbiIsInN0cmlwVGFnc19mbiIsIm1lcmdlQ29uZmlnc19mbiIsIl9ub3JtYWxpemVQbHVnaW5zVG9IYXNoIiwibm9ybWFsaXplUGx1Z2luc19mbiIsImNyZWF0ZVRvbVNlbGVjdF9mbiIsImNvbnRyb2xsZXJfZGVmYXVsdCIsIl90aGlzIiwiaXNPYnNlcnZpbmciLCJoYXNMb2FkZWRDaG9pY2VzUHJldmlvdXNseSIsIm9yaWdpbmFsT3B0aW9ucyIsInBsdWdpbnMiLCJBcnJheSIsImlzQXJyYXkiLCJyZWR1Y2UiLCJhY2MiLCJwbHVnaW4iLCJfdHlwZW9mIiwibmFtZSIsIm9wdGlvbnMiLCJpbml0aWFsaXplIiwiX3RoaXMyIiwibXV0YXRpb25PYnNlcnZlciIsIk11dGF0aW9uT2JzZXJ2ZXIiLCJtdXRhdGlvbnMiLCJvbk11dGF0aW9ucyIsInNlbGVjdEVsZW1lbnQiLCJjcmVhdGVPcHRpb25zRGF0YVN0cnVjdHVyZSIsImluaXRpYWxpemVUb21TZWxlY3QiLCJzZXRBdHRyaWJ1dGUiLCJ1cmxWYWx1ZSIsInRvbVNlbGVjdCIsImhhc01pbkNoYXJhY3RlcnNWYWx1ZSIsIm1pbkNoYXJhY3RlcnNWYWx1ZSIsIm9wdGlvbnNBc0h0bWxWYWx1ZSIsInN0YXJ0TXV0YXRpb25PYnNlcnZlciIsImRpc2Nvbm5lY3QiLCJzdG9wTXV0YXRpb25PYnNlcnZlciIsImN1cnJlbnRTZWxlY3RlZFZhbHVlcyIsIm11bHRpcGxlIiwiZnJvbSIsImZpbHRlciIsIm9wdGlvbiIsInNlbGVjdGVkIiwibWFwIiwiZGVzdHJveSIsImZvckVhY2giLCJpbmNsdWRlcyIsInVybFZhbHVlQ2hhbmdlZCIsInJlc2V0VG9tU2VsZWN0IiwiZ2V0TWF4T3B0aW9ucyIsImxlbmd0aCIsIkhUTUxTZWxlY3RFbGVtZW50IiwiSFRNTElucHV0RWxlbWVudCIsIkVycm9yIiwiZGlzcGF0Y2hFdmVudCIsInBheWxvYWQiLCJkaXNwYXRjaCIsImRldGFpbCIsInByZWZpeCIsImhhc1ByZWxvYWRWYWx1ZSIsInByZWxvYWRWYWx1ZSIsImN1cnJlbnRIdG1sIiwiaW5uZXJIVE1MIiwiY3VycmVudFZhbHVlIiwiZ2V0VmFsdWUiLCJzZXRWYWx1ZSIsImNoYW5nZVRvbVNlbGVjdERpc2FibGVkU3RhdGUiLCJpc0Rpc2FibGVkIiwiZGlzYWJsZSIsImVuYWJsZSIsIm9ic2VydmUiLCJjaGlsZExpc3QiLCJzdWJ0cmVlIiwiYXR0cmlidXRlcyIsImNoYXJhY3RlckRhdGEiLCJhdHRyaWJ1dGVPbGRWYWx1ZSIsIl90aGlzMyIsImNoYW5nZURpc2FibGVkU3RhdGUiLCJyZXF1aXJlUmVzZXQiLCJtdXRhdGlvbiIsInR5cGUiLCJ0YXJnZXQiLCJhdHRyaWJ1dGVOYW1lIiwiaXNOb3dNdWx0aXBsZSIsImhhc0F0dHJpYnV0ZSIsIndhc011bHRpcGxlIiwib2xkVmFsdWUiLCJuZXdPcHRpb25zIiwiYXJlT3B0aW9uc0VxdWl2YWxlbnQiLCJmb3JtRWxlbWVudCIsImRpc2FibGVkIiwidGV4dCIsImZpbHRlcmVkT3JpZ2luYWxPcHRpb25zIiwiZmlsdGVyZWROZXdPcHRpb25zIiwib3JpZ2luYWxQbGFjZWhvbGRlck9wdGlvbiIsImZpbmQiLCJuZXdQbGFjZWhvbGRlck9wdGlvbiIsIm5vcm1hbGl6ZU9wdGlvbiIsImNvbmNhdCIsIm9yaWdpbmFsT3B0aW9uc1NldCIsIlNldCIsIm5ld09wdGlvbnNTZXQiLCJzaXplIiwiX3RvQ29uc3VtYWJsZUFycmF5IiwiZXZlcnkiLCJfdGhpczQiLCJpc011bHRpcGxlIiwiY2xlYXJfYnV0dG9uIiwidGl0bGUiLCJyZW1vdmVfYnV0dG9uIiwidmlydHVhbF9zY3JvbGwiLCJyZW5kZXIiLCJub19yZXN1bHRzIiwibm9SZXN1bHRzRm91bmRUZXh0VmFsdWUiLCJvcHRpb25fY3JlYXRlIiwiZGF0YSIsImVzY2FwZURhdGEiLCJjcmVhdGVPcHRpb25UZXh0VmFsdWUiLCJyZXBsYWNlIiwiaW5wdXQiLCJjb25maWciLCJvbkl0ZW1BZGQiLCJzZXRUZXh0Ym94VmFsdWUiLCJjbG9zZUFmdGVyU2VsZWN0Iiwib25PcHRpb25BZGQiLCJwYXJlbnRFbGVtZW50Iiwib3B0Z3JvdXBEYXRhIiwib3B0Z3JvdXAiLCJzZXR0aW5ncyIsIm9wdGdyb3VwRmllbGQiLCJvcHRncm91cHMiLCJvcHRncm91cEVsZW1lbnQiLCJxdWVyeVNlbGVjdG9yIiwibGFiZWwiLCJvcHRpb25FbGVtZW50IiwiZG9jdW1lbnQiLCJjcmVhdGVFbGVtZW50IiwibGFiZWxGaWVsZCIsIm9wdGlvbk9yZGVyIiwiJG9yZGVyIiwib3JkZXJlZE9wdGlvbiIsIl9pIiwiX09iamVjdCRlbnRyaWVzIiwiT2JqZWN0IiwiZW50cmllcyIsIl9PYmplY3QkZW50cmllcyRfaSIsIl9zbGljZWRUb0FycmF5IiwidG9tU2VsZWN0T3B0aW9uIiwiQ1NTIiwiZXNjYXBlIiwidmFsdWVGaWVsZCIsImluc2VydEFkamFjZW50RWxlbWVudCIsImFwcGVuZCIsInByZXBlbmQiLCJzaG91bGRMb2FkIiwidG9tU2VsZWN0T3B0aW9uc1ZhbHVlIiwibWF4T3B0aW9ucyIsIl9jb21tb25Db25maWckbGFiZWxGaSIsIl90aGlzNSIsImNvbW1vbkNvbmZpZyIsInNjb3JlIiwic2VhcmNoIiwic2NvcmluZ0Z1bmN0aW9uIiwiZ2V0U2NvcmVGdW5jdGlvbiIsIml0ZW0iLCJfb2JqZWN0U3ByZWFkIiwiYXV0b2NvbXBsZXRlRW5kcG9pbnRVcmwiLCJtaW5DaGFyYWN0ZXJMZW5ndGgiLCJfY29tbW9uQ29uZmlnJGxhYmVsRmkyIiwiX3RoaXM3IiwiZmlyc3RVcmwiLCJxdWVyeSIsInNlcGFyYXRvciIsImVuY29kZVVSSUNvbXBvbmVudCIsImxvYWQiLCJjYWxsYmFjayIsIl90aGlzNiIsInVybCIsImdldFVybCIsImZldGNoIiwidGhlbiIsInJlc3BvbnNlIiwianNvbiIsInNldE5leHRVcmwiLCJuZXh0X3BhZ2UiLCJyZXN1bHRzIiwibG9hZGluZ19tb3JlIiwibG9hZGluZ01vcmVUZXh0VmFsdWUiLCJub19tb3JlX3Jlc3VsdHMiLCJub01vcmVSZXN1bHRzVGV4dFZhbHVlIiwicHJlbG9hZCIsInN0cmluZyIsImNvbmZpZzEiLCJjb25maWcyIiwiV2Vha01hcCIsIl9yZWYiLCJfcmVmMiIsInBsdWdpbk5hbWUiLCJwbHVnaW5PcHRpb25zIiwicHJlQ29ubmVjdFBheWxvYWQiLCJjb25uZWN0UGF5bG9hZCIsInZhbHVlcyIsIlN0cmluZyIsIm9wdGlvbnNBc0h0bWwiLCJCb29sZWFuIiwibG9hZGluZ01vcmVUZXh0Iiwibm9SZXN1bHRzRm91bmRUZXh0Iiwibm9Nb3JlUmVzdWx0c1RleHQiLCJjcmVhdGVPcHRpb25UZXh0IiwibWluQ2hhcmFjdGVycyIsIk51bWJlciIsInRvbVNlbGVjdE9wdGlvbnMiXSwiaWdub3JlTGlzdCI6W10sInNvdXJjZVJvb3QiOiIifQ==