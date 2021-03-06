"use strict";

Object.defineProperty(exports, "__esModule", {
  value: true
});
exports.transformAsync = exports.transformSync = exports.transform = void 0;

var _config = _interopRequireDefault(require("./config"));

var _transformation = require("./transformation");

function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

const gensync = require("gensync");

const transformRunner = gensync(function* transform(code, opts) {
  const config = yield* (0, _config.default)(opts);
  if (config === null) return null;
  return yield* (0, _transformation.run)(config, code);
});

const transform = function transform(code, opts, callback) {
  if (typeof opts === "function") {
    callback = opts;
    opts = undefined;
  }

  if (callback === undefined) return transformRunner.sync(code, opts);
  transformRunner.errback(code, opts, callback);
};

exports.transform = transform;
const transformSync = transformRunner.sync;
exports.transformSync = transformSync;
const transformAsync = transformRunner.async;
exports.transformAsync = transformAsync;