"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
Object.defineProperty(exports, "VISITOR_KEYS", {
  enumerable: true,
  get: function () {
    return _utils.VISITOR_KEYS;
  }
});
Object.defineProperty(exports, "ALIAS_KEYS", {
  enumerable: true,
  get: function () {
    return _utils.ALIAS_KEYS;
  }
});
Object.defineProperty(exports, "FLIPPED_ALIAS_KEYS", {
  enumerable: true,
  get: function () {
    return _utils.FLIPPED_ALIAS_KEYS;
  }
});
Object.defineProperty(exports, "NODE_FIELDS", {
  enumerable: true,
  get: function () {
    return _utils.NODE_FIELDS;
  }
});
Object.defineProperty(exports, "BUILDER_KEYS", {
  enumerable: true,
  get: function () {
    return _utils.BUILDER_KEYS;
  }
});
Object.defineProperty(exports, "DEPRECATED_KEYS", {
  enumerable: true,
  get: function () {
    return _utils.DEPRECATED_KEYS;
  }
});
Object.defineProperty(exports, "NODE_PARENT_VALIDATIONS", {
  enumerable: true,
  get: function () {
    return _utils.NODE_PARENT_VALIDATIONS;
  }
});
Object.defineProperty(exports, "PLACEHOLDERS", {
  enumerable: true,
  get: function () {
    return _placeholders.PLACEHOLDERS;
  }
});
Object.defineProperty(exports, "PLACEHOLDERS_ALIAS", {
  enumerable: true,
  get: function () {
    return _placeholders.PLACEHOLDERS_ALIAS;
  }
});
Object.defineProperty(exports, "PLACEHOLDERS_FLIPPED_ALIAS", {
  enumerable: true,
  get: function () {
    return _placeholders.PLACEHOLDERS_FLIPPED_ALIAS;
  }
});
exports.TYPES = void 0;

require("./core");

require("./flow");

require("./jsx");

require("./misc");

require("./experimental");

require("./typescript");

var _utils = require("./utils");

var _placeholders = require("./placeholders");

const toFastProperties = require("to-fast-properties");

toFastProperties(_utils.VISITOR_KEYS);
toFastProperties(_utils.ALIAS_KEYS);
toFastProperties(_utils.FLIPPED_ALIAS_KEYS);
toFastProperties(_utils.NODE_FIELDS);
toFastProperties(_utils.BUILDER_KEYS);
toFastProperties(_utils.DEPRECATED_KEYS);
toFastProperties(_placeholders.PLACEHOLDERS_ALIAS);
toFastProperties(_placeholders.PLACEHOLDERS_FLIPPED_ALIAS);
const TYPES = Object.keys(_utils.VISITOR_KEYS).concat(Object.keys(_utils.FLIPPED_ALIAS_KEYS)).concat(Object.keys(_utils.DEPRECATED_KEYS));
exports.TYPES = TYPES;