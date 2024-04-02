/**
 * Deep Clone
 */

// Implementing the deepClone function
function deepClone(obj) {
    if (obj === null || typeof obj !== 'object') {
        return obj; // If obj is not an object, return it as is
    }
    // Create a new object or array to hold the cloned values
    const clone = Array.isArray(obj) ? [] : {};

    // Iterate through each key in obj
    for (let key in obj) {
        if (Object.prototype.hasOwnProperty.call(obj, key)) {
            // Recursively clone nested objects or arrays
            clone[key] = deepClone(obj[key]);
        }
    }

    return clone;
}






