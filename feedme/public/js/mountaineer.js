/**
 * Get closest DOM element up the tree that contains a class, ID, or data attribute
 * @param  {Element} elem The base element
 * @param  {String} selector The class or data attribute to look for
 * @return {Boolean|Element} False if no match
 */
var getClosest = function(elem, selector) {

    var firstChar = selector.charAt(0);

    // Get closest match
    for (; elem && elem !== document; elem = elem.parentNode) {
        if (firstChar === '.') {
            if (elem.classList.contains(selector.substr(1))) {
                return elem;
            }
        } else if (firstChar === '#') {
            if (elem.id === selector.substr(1)) {
                return elem;
            }
        } else if (firstChar === '[') {
            if (elem.hasAttribute(selector.substr(1, selector.length - 1))) {
                return elem;
            }
        }
    }

    return false;

};


/**
 * Get all DOM element up the tree that contain a class, ID, or data attribute
 * @param  {Element} elem The base element
 * @param  {String} selector The class or data attribute to look for
 * @return {Boolean|Array} False if no match
 */
var getParents = function(elem, selector) {

    var firstChar = selector.charAt(0);
    var parents = [];

    // Get closest match
    for (; elem && elem !== document; elem = elem.parentNode) {
        if (firstChar === '.') {
            if (elem.classList.contains(selector.substr(1))) {
                parents.push(elem);
            }
        } else if (firstChar === '#') {
            if (elem.id === selector.substr(1)) {
                parents.push(elem);
            }
        } else if (firstChar === '[') {
            if (elem.hasAttribute(selector.substr(1, selector.length - 1))) {
                parents.push(elem);
            }
        }
    }

    if (parents.length === 0) {
        return false;
    } else {
        return parents;
    }

};