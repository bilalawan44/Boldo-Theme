/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/css/editor-style.css":
/*!****************************************!*\
  !*** ./resources/css/editor-style.css ***!
  \****************************************/
/***/ ((__unused_webpack_module, __webpack_exports__, __webpack_require__) => {

"use strict";
__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/***/ (() => {

// Menu Toggle Button
document.addEventListener('DOMContentLoaded', function () {
  var menuBtn = document.getElementById('menuBtn');
  var mainMenu = document.getElementById('mainMenu');
  if (menuBtn && mainMenu) {
    menuBtn.addEventListener('click', function () {
      mainMenu.classList.toggle('hidden');
    });
  }
});

// Accordion Section
function toggleAccordion(button) {
  var content = button.nextElementSibling;
  var icon = button.querySelector('.rotate-icon');
  var allContents = document.querySelectorAll('.accordion-content');
  var allIcons = document.querySelectorAll('.rotate-icon');
  allContents.forEach(function (item) {
    if (item !== content) item.classList.remove('active');
  });
  allIcons.forEach(function (item) {
    if (item !== icon) item.classList.remove('active');
  });
  content.classList.toggle('active');
  icon.classList.toggle('active');
}
document.addEventListener('DOMContentLoaded', function () {
  var accordionTriggers = document.querySelectorAll('[data-accordion-trigger]');
  accordionTriggers.forEach(function (trigger) {
    trigger.addEventListener('click', function () {
      toggleAccordion(this);
    });
  });
});

// ============================================================
// BLOG LOAD MORE / OFFLOAD — WITH AJAX SUPPORT
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
  var grid = document.getElementById('blogGrid');
  var loadMoreBtn = document.getElementById('loadMoreBtn');
  var offloadBtn = document.getElementById('offloadBtn');
  if (!grid || !loadMoreBtn) return;
  var initialPosts = parseInt(grid.dataset.initialPosts) || 6;
  var loadMoreCount = parseInt(grid.dataset.loadMoreCount) || 3;
  var totalPosts = parseInt(grid.dataset.totalPosts) || 0;
  var excludedIds = grid.dataset.excludedIds || '';
  var visibleCount = Array.from(grid.querySelectorAll('.blog-card')).filter(function (c) {
    return !c.classList.contains('hidden');
  }).length;
  var ajaxOffset = 0;

  // ── Load More ─────────────────────────────────────────────────────────────
  function showNextBatch() {
    var firstNewIndex = visibleCount;
    var shown = 0;
    var hidden = Array.from(grid.querySelectorAll('.blog-card.hidden'));

    // Step 1: Hidden DOM cards pehle dikhao
    for (var i = 0; i < hidden.length && shown < loadMoreCount; i++) {
      hidden[i].classList.remove('hidden');
      visibleCount++;
      shown++;
    }

    // Naye cards pe scroll karo
    setTimeout(function () {
      var allCards = Array.from(grid.querySelectorAll('.blog-card'));
      var firstNewCard = allCards[firstNewIndex];
      if (firstNewCard) {
        var yOffset = -10;
        var y = firstNewCard.getBoundingClientRect().top + window.pageYOffset + yOffset;
        window.scrollTo({
          top: y,
          behavior: 'smooth'
        });
      }
    }, 150);

    // Step 2: Agar aur chahiye to AJAX
    if (shown < loadMoreCount && visibleCount < totalPosts) {
      fetchMorePosts(loadMoreCount - shown, firstNewIndex + shown);
    } else {
      updateButtons();
    }
  }

  // ── AJAX fetch ────────────────────────────────────────────────────────────
  function fetchMorePosts(count, scrollToIndex) {
    loadMoreBtn.disabled = true;
    loadMoreBtn.textContent = 'Loading...';
    var data = new FormData();
    data.append('action', 'blog_load_more');
    data.append('nonce', blogAjax.nonce);
    data.append('ajax_offset', ajaxOffset);
    data.append('count', count);
    data.append('excluded_ids', excludedIds);
    fetch(blogAjax.ajax_url, {
      method: 'POST',
      body: data
    }).then(function (r) {
      return r.json();
    }).then(function (res) {
      if (res.success && res.data.html && res.data.count > 0) {
        grid.insertAdjacentHTML('beforeend', res.data.html);
        ajaxOffset += res.data.count;
        visibleCount += res.data.count;
        setTimeout(function () {
          var allCards = Array.from(grid.querySelectorAll('.blog-card'));
          var firstNewCard = allCards[scrollToIndex];
          if (firstNewCard) {
            var yOffset = -10;
            var y = firstNewCard.getBoundingClientRect().top + window.pageYOffset + yOffset;
            window.scrollTo({
              top: y,
              behavior: 'smooth'
            });
          }
        }, 150);
      }
      loadMoreBtn.disabled = false;
      loadMoreBtn.textContent = 'Load more';
      updateButtons();
    })["catch"](function () {
      loadMoreBtn.disabled = false;
      loadMoreBtn.textContent = 'Load more';
    });
  }

  // ── Offload — Step by step (Load More ki tarah ulta) ─────────────────────
  function offload() {
    var allCards = Array.from(grid.querySelectorAll('.blog-card'));

    // Kitni cards visible hain abhi
    var currentVisible = allCards.filter(function (c) {
      return !c.classList.contains('hidden');
    }).length;

    // Agar already initial pe aa gaye to kuch nahi karna
    if (currentVisible <= initialPosts) return;

    // Pichli `loadMoreCount` cards hide karo
    var newVisible = Math.max(currentVisible - loadMoreCount, initialPosts);

    // newVisible se aage wali cards hide karo
    allCards.forEach(function (card, i) {
      if (i >= newVisible) {
        card.classList.add('hidden');
      }
    });
    visibleCount = newVisible;

    // Last visible card pe scroll karo (jaise Load More mein pehli nai card pe jate hain)
    setTimeout(function () {
      var lastVisibleCard = allCards[newVisible - 1];
      if (lastVisibleCard) {
        var yOffset = -10;
        var y = lastVisibleCard.getBoundingClientRect().top + window.pageYOffset + yOffset;
        window.scrollTo({
          top: y,
          behavior: 'smooth'
        });
      }
    }, 150);
    updateButtons();
  }

  // ── Buttons ───────────────────────────────────────────────────────────────
  function updateButtons() {
    loadMoreBtn.classList.toggle('hidden', visibleCount >= totalPosts);
    if (offloadBtn) offloadBtn.classList.toggle('hidden', visibleCount <= initialPosts);
  }
  loadMoreBtn.addEventListener('click', showNextBatch);
  if (offloadBtn) offloadBtn.addEventListener('click', offload);
  updateButtons();
});

// ============================================================
// Splide Section (testimonial section)
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
  var sliderEl = document.getElementById('testimonial-slider');
  if (!sliderEl) return;
  try {
    var splide = new Splide('#testimonial-slider', {
      type: 'loop',
      perPage: 3,
      perMove: 1,
      gap: '24px',
      arrows: false,
      pagination: false,
      breakpoints: {
        1024: {
          perPage: 3
        },
        768: {
          perPage: 2
        },
        425: {
          perPage: 1
        }
      }
    });
    splide.mount();
    var prevBtn = document.getElementById('prevBtn');
    var nextBtn = document.getElementById('nextBtn');
    if (prevBtn && nextBtn) {
      prevBtn.addEventListener('click', function () {
        return splide.go('<');
      });
      nextBtn.addEventListener('click', function () {
        return splide.go('>');
      });
    }
  } catch (e) {
    console.warn('[Splide] Slider init failed:', e.message);
  }
});

// ============================================================
// About Counter JS - Ultra Smooth Version
// ============================================================

document.addEventListener('DOMContentLoaded', function () {
  function animateCounter(el) {
    var target = parseInt(el.dataset.target, 10);
    var suffix = el.dataset.suffix || '';
    var sep = el.dataset.separator || '';
    var duration = 2000;
    var start = performance.now();
    function format(num) {
      var str = Math.round(num).toString();
      if (sep) str = str.replace(/\B(?=(\d{3})+(?!\d))/g, sep);
      return str + suffix;
    }
    function step(now) {
      var elapsed = now - start;
      var progress = Math.min(elapsed / duration, 1);
      var eased = progress === 1 ? 1 : 1 - Math.pow(2, -10 * progress);
      el.textContent = format(eased * target);
      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = format(target);
      }
    }
    requestAnimationFrame(step);
  }
  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting && !entry.target.dataset.animated) {
        entry.target.dataset.animated = 'true';
        setTimeout(function () {
          animateCounter(entry.target);
        }, 100);
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.2,
    rootMargin: '0px 0px -50px 0px'
  });
  document.querySelectorAll('.counter-number').forEach(function (el) {
    observer.observe(el);
  });
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
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	(() => {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = (result, chunkIds, fn, priority) => {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var [chunkIds, fn, priority] = deferred[i];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every((key) => (__webpack_require__.O[key](chunkIds[j])))) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
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
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	(() => {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"/js/app": 0,
/******/ 			"css/editor-style": 0,
/******/ 			"css/app": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = (chunkId) => (installedChunks[chunkId] === 0);
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = (parentChunkLoadingFunction, data) => {
/******/ 			var [chunkIds, moreModules, runtime] = data;
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some((id) => (installedChunks[id] !== 0))) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunktailpress"] = self["webpackChunktailpress"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	})();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	__webpack_require__.O(undefined, ["css/editor-style","css/app"], () => (__webpack_require__("./resources/js/app.js")))
/******/ 	__webpack_require__.O(undefined, ["css/editor-style","css/app"], () => (__webpack_require__("./resources/css/app.css")))
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["css/editor-style","css/app"], () => (__webpack_require__("./resources/css/editor-style.css")))
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;