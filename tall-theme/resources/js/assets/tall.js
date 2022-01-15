/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./packages/tall-theme/resources/js/components/index.js":
/*!**************************************************************!*\
  !*** ./packages/tall-theme/resources/js/components/index.js ***!
  \**************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _tall_flat_pickr__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./tall-flat-pickr */ "./packages/tall-theme/resources/js/components/tall-flat-pickr.js");

window.tallFlatPickr = _tall_flat_pickr__WEBPACK_IMPORTED_MODULE_0__["default"];
document.addEventListener('alpine:init', function () {
  window.Alpine.data('tallFlatPickr', _tall_flat_pickr__WEBPACK_IMPORTED_MODULE_0__["default"]);
});

/***/ }),

/***/ "./packages/tall-theme/resources/js/components/tall-flat-pickr.js":
/*!************************************************************************!*\
  !*** ./packages/tall-theme/resources/js/components/tall-flat-pickr.js ***!
  \************************************************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (__WEBPACK_DEFAULT_EXPORT__)
/* harmony export */ });
function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); enumerableOnly && (symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; })), keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = null != arguments[i] ? arguments[i] : {}; i % 2 ? ownKeys(Object(source), !0).forEach(function (key) { _defineProperty(target, key, source[key]); }) : Object.getOwnPropertyDescriptors ? Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)) : ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

/* harmony default export */ const __WEBPACK_DEFAULT_EXPORT__ = (function (params) {
  var _params$label, _params$locale, _params$onlyFuture, _params$noWeekEnds, _params$customConfig;

  return {
    dataField: params.dataField,
    tableName: params.tableName,
    filterKey: params.filterKey,
    label: (_params$label = params.label) !== null && _params$label !== void 0 ? _params$label : null,
    locale: (_params$locale = params.locale) !== null && _params$locale !== void 0 ? _params$locale : 'en',
    onlyFuture: (_params$onlyFuture = params.onlyFuture) !== null && _params$onlyFuture !== void 0 ? _params$onlyFuture : false,
    noWeekEnds: (_params$noWeekEnds = params.noWeekEnds) !== null && _params$noWeekEnds !== void 0 ? _params$noWeekEnds : false,
    customConfig: (_params$customConfig = params.customConfig) !== null && _params$customConfig !== void 0 ? _params$customConfig : null,
    init: function init() {
      var _this = this;

      var options = _objectSpread(_objectSpread({
        mode: 'range',
        defaultHour: 0
      }, this.locale), this.customConfig);

      if (this.onlyFuture) {
        options.minDate = 'today';
      }

      if (this.noWeekEnds) {
        options.disable = [function (date) {
          return date.getDay() === 0 || date.getDay() === 6;
        }];
      }

      options.onClose = function (selectedDates, dateStr, instance) {
        if (selectedDates.length > 0) {
          window.livewire.emit('pg:datePicker-' + _this.tableName, {
            selectedDates: selectedDates,
            field: _this.dataField,
            values: _this.filterKey,
            label: _this.label
          });
        }
      };

      if (this.$refs.rangeInput) {
        flatpickr(this.$refs.rangeInput, options);
      }
    }
  };
});

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.prototype.hasOwnProperty.call(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
(() => {
/*!*************************************************!*\
  !*** ./packages/tall-theme/resources/js/app.js ***!
  \*************************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _components__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./components */ "./packages/tall-theme/resources/js/components/index.js");

})();

/******/ })()
;