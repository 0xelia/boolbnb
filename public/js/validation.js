/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/validation.js":
/*!************************************!*\
  !*** ./resources/js/validation.js ***!
  \************************************/
/*! no static exports found */
/***/ (function(module, exports) {

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }
function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }
function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }
var imageEl = document.getElementById('image');
var imagesEl = document.getElementById('images');
var buttonEl = document.getElementById('submit');
var titleWrapper = document.querySelector('.title-wrapper');
var titleInput = document.getElementById('title');
var titleError = document.querySelector('.title-error');
var roomsWrapper = document.querySelector('.rooms-wrapper');
var roomsInput = document.getElementById('rooms');
var roomsError = document.querySelector('.rooms-error');
var bedsWrapper = document.querySelector('.beds-wrapper');
var bedsInput = document.getElementById('beds');
var bedsError = document.querySelector('.beds-error');
var bathsWrapper = document.querySelector('.baths-wrapper');
var bathsInput = document.getElementById('baths');
var bathsError = document.querySelector('.baths-error');
var metersWrapper = document.querySelector('.meters-wrapper');
var metersInput = document.getElementById('meters');
var metersError = document.querySelector('.meters-error');
var addressWrapper = document.querySelector('.address-wrapper');
var addressInput = document.querySelector('.tt-search-box-input');
var addressError = document.querySelector('.address-error');
var priceWrapper = document.querySelector('.price-wrapper');
var priceInput = document.getElementById('price');
var priceError = document.querySelector('.price-error');
var visibilityWrapper = document.querySelector('.visibility-wrapper');
var visibilityError = document.querySelector('.visibility-error');
titleInput.addEventListener('focusout', function (event) {
  if (!titleInput.validity.valid) {
    titleError.textContent = 'Il titolo deve avere massimo 255 caratteri';
    titleWrapper.classList.add('text-red-700');
    titleInput.classList.add('border-red-700', 'border-2');
  } else {
    titleError.textContent = '';
    titleWrapper.classList.remove('text-red-700');
    titleInput.classList.remove('border-red-700', 'border-2');
  }
});
roomsInput.addEventListener('focusout', function (event) {
  if (!roomsInput.validity.valid) {
    roomsError.textContent = 'Inserisci un numero valido';
    roomsWrapper.classList.add('text-red-700');
    roomsInput.classList.add('border-red-700', 'border-2');
  } else {
    roomsError.textContent = '';
    roomsWrapper.classList.remove('text-red-700');
    roomsInput.classList.remove('border-red-700', 'border-2');
  }
});
bedsInput.addEventListener('focusout', function (event) {
  if (!bedsInput.validity.valid) {
    bedsError.textContent = 'Inserisci un numero valido';
    bedsWrapper.classList.add('text-red-700');
    bedsInput.classList.add('border-red-700', 'border-2');
  } else {
    bedsError.textContent = '';
    bedsWrapper.classList.remove('text-red-700');
    bedsInput.classList.remove('border-red-700', 'border-2');
  }
});
bathsInput.addEventListener('focusout', function (event) {
  if (!bathsInput.validity.valid) {
    bathsError.textContent = 'Inserisci un numero valido';
    bathsWrapper.classList.add('text-red-700');
    bathsInput.classList.add('border-red-700', 'border-2');
  } else {
    bathsError.textContent = '';
    bathsWrapper.classList.remove('text-red-700');
    bathsInput.classList.remove('border-red-700', 'border-2');
  }
});
metersInput.addEventListener('focusout', function (event) {
  if (!metersInput.validity.valid) {
    metersError.textContent = 'Inserisci un numero valido';
    metersWrapper.classList.add('text-red-700');
    metersInput.classList.add('border-red-700', 'border-2');
  } else {
    metersError.textContent = '';
    metersWrapper.classList.remove('text-red-700');
    metersInput.classList.remove('border-red-700', 'border-2');
  }
});
addressInput.addEventListener('focusout', function (event) {
  if (!addressInput.value) {
    addressError.textContent = 'Inserisci un indirizzo valido';
    addressWrapper.classList.add('text-red-700');
    addressInput.classList.add('border-red-700', 'border-2');
  } else {
    addressError.textContent = '';
    addressWrapper.classList.remove('text-red-700');
    addressInput.classList.remove('border-red-700', 'border-2');
  }
});
priceInput.addEventListener('focusout', function (event) {
  if (!metersInput.validity.valid) {
    priceError.textContent = 'Inserisci un numero valido';
    priceWrapper.classList.add('text-red-700');
    priceInput.classList.add('border-red-700', 'border-2');
  } else {
    priceError.textContent = '';
    priceWrapper.classList.remove('text-red-700');
    priceInput.classList.remove('border-red-700', 'border-2');
  }
});

// titleWrapper.addEventListener('focusout', formValidation, error='title-error', message='Inserisci un titolo compreso tra 5 e 255 caratteri');
// roomsWrapper.addEventListener('focusout', formValidation, error='rooms-error', message='Inserisci un numero da 1 a 255');
// bedsWrapper.addEventListener('focusout', formValidation, error='beds-error', message='Inserisci un numero tra 1 e 255');
// bathsWrapper.addEventListener('focusout', formValidation, error='baths-error', message='Inserisci un numero tra 0 e 255');
// metersWrapper.addEventListener('focusout', formValidation, error='meters-error', message='Inserisci un numero tra 0 e 65535');

// function formValidation(event) {
//     const wrapperEl = this;
//     const inputEl = event.target;
//     const errorEl = wrapperEl.querySelector('.' + error);

//     console.log(wrapperEl);
//     console.log(inputEl);
//     console.log(errorEl);

//     if (!inputEl.validity.valid) {
//         errorEl.textContent = message;
//         wrapperEl.classList.add('text-red-700');
//         inputEl.classList.add('border-red-700', 'border-2');
//     }
//     else {
//         errorEl.textContent = '';
//         wrapperEl.classList.remove('text-red-700');
//         inputEl.classList.remove('border-red-700', 'border-2');
//     }
// }

if (imageEl) {
  imageEl.addEventListener('change', checkSize);
}
function checkSize() {
  var id = this.id.concat('_error');
  var image_error = document.getElementById(id);
  var files = _toConsumableArray(this.files);
  files.every(function (image) {
    if (image.size > 2097152) {
      image_error.classList.remove('hidden');
      return false;
    } else {
      image_error.classList.add('hidden');
    }
  });
}
if (imagesEl) {
  imagesEl.addEventListener('change', checkSize);
}

// buttonEl.addEventListener('click', function (event) {
//     if (
//         titleInput.value && 
//         roomsInput.value && 
//         bedsInput.value &&
//         bathsInput.value &&
//         metersInput.value &&
//         addressInput.value &&
//         priceInput.value
//     ) {
//         buttonEl.setAttribute('type', 'submit');
//     }

// })

/***/ }),

/***/ 1:
/*!******************************************!*\
  !*** multi ./resources/js/validation.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/eliavanon/Desktop/ESERCIZI_BOOLEAN/boolbnb/resources/js/validation.js */"./resources/js/validation.js");


/***/ })

/******/ });