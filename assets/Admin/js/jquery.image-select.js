/**
 * 图片选择器插件
 * @author  church
 * @date 2016-03-07
 * @license MIT 
 */
(function($) {
	"use strict";

	var directory = 'uploads';

	var C = {
		id: function(id) {
			return $('#' + id);
		},
		class: function(cls) {
			return $('.' + cls);
		}
	}

	var Box = {
		/**
		 * 预览图
		 * @type {String}
		 */
		_Preview: 'churchPreview',
		/**
		 * 遮层
		 * @type {String}
		 */
		_Mask: 'churchMask',
		/**
		 * 图片选择器class
		 * @type {String}
		 */
		_BoxClass: 'churchSelectBox',
		/**
		 * 返回上一级class
		 * @type {String}
		 */
		_BoxBackClass: 'churchBack',
		/**
		 * 图片选择器目录class
		 * @type {String}
		 */
		_BoxDirectoryClass: 'churchSelectBoxDirectory',
		/**
		 * 图片选择器图片class
		 * @type {String}
		 */
		_BoxImageClass: 'churchSelectBoxImage',
		/**
		 * 目录访问栈
		 * @type {String}
		 */
		_DirStack: [],
		/**
		 * 接收选择图片的容器ID
		 * @type {String}
		 */
		target: '',
		/**
		 * 选择回调
		 * @return {[type]} [description]
		 */
		_Callback: function() {},
		/**
		 * 初始化box
		 * @param  {[type]} target [description]
		 * @return {[type]}        [description]
		 */
		init: function(target) {
			this._DirStack.length >= 1 ? '' : this._DirStack.push(directory);
			this.target = target;
			return this;
		},
		/**
		 * 绘制box
		 * @return {[type]} [description]
		 */
		_RenderBox: function() {
			$('<div id="' + this._Mask + '"></div>').appendTo('body');
			$('<div class="churchSelectBox"></div>').appendTo('body');
		},
		/**
		 * 获取图片
		 * @return {[type]} [description]
		 */
		_GetImages: function(baseDir, flag) {
			var _this = this,
				baseDir = '';
			flag && _this._DirStack.pop();
			baseDir = _this._DirStack.join('/') + '/';
			$.post('/Backend/common/GetFiles', {baseDir: baseDir}, function(result) {
				var html = '';
				if (_this._DirStack.length > 1) {
					html += '<dl class="' + _this._BoxBackClass + '">';
					html += '<dt><img src="/assets/Admin/images/iconfont-fanhuishangyijijiantou.png" /></dt>';
					html += '<dd>返回上一级</dd>';
					html += '</dl>';
				}
				for (var i in result.files.directories) {
					html += '<dl class="' + _this._BoxDirectoryClass + '" value="' + result.files.directories[i] + '">';
					html += '<dt><img src="/assets/Admin/images/iconfont-dianbozhibov1213.png" /></dt>';
					html += '<dd>' + result.files.directories[i] + '</dd>';
					html += '</dl>';
				}

				for (var i in result.files.files) {
					html += '<dl class="' + _this._BoxImageClass + '" value="/' + baseDir + result.files.files[i] + '">';
					html += '<dt><img src="/' + baseDir + result.files.files[i]  +'" /></dt>';
					html += '<dd>' + result.files.files[i] + '</dd>';
					html += '</dl>';
				}

				C.class(_this._BoxClass).html(html);
				_this._BindEvents();
			}, 'json');
		},
		_BindEvents: function() {
			var _this = this;
			/**
			 * 目录点击事件
			 */
			C.class(_this._BoxDirectoryClass).on('click', function() {
				var value = $(this).attr('value');
				_this._DirStack.push(value);
				_this._GetImages(value);
			});
			/**
			 * 返回上一级点击事件
			 */
			C.class(_this._BoxBackClass).on('click', function() {
				_this._GetImages($(this).attr('value'), true);
			});
			/**
			 * 图片点击事件
			 */
			C.class(_this._BoxImageClass).on('click', function() {
				(_this._Callback)();
				_this.clearAll();
			}).on('mouseover', function() {
				C.class(_this._Preview).html('<img src="' + $(this).attr('value') + '" style="max-width:400px; max-height:400px;" />');
			});
			/**
			 * 空白处点击事件
			 */
			C.id(_this._Mask).click(function() {
				_this.clearAll();
			});
		},
		ImageSelect: function(callback) {
			_this._Callback = callback;
		},
		/**
		 * 清除所有box
		 * @return {[type]} [description]
		 */
		clearAll: function() {
			C.class(this._BoxClass).remove();
			C.id(this._Mask).remove();
			return this;
		},
		/**
		 * 显示一个box
		 * @return {[type]} [description]
		 */
		show: function() {
			this._RenderBox();
			this._GetImages();
		}
	};

	function Watcher() {
		var target = $(this).attr('target');

		if (target == 'undefined') {
			console.log('The attribute target of selector is undefined');
			return;
		}

		$(this).on('click', function(event) {
			Box.init(target).clearAll().show();
			event.stopPropagation();
		});
	}

	$.fn.extend({
		ImageSelector: function() {
			this.each(function() {
				Watcher.call(this);
			});
		}
	});
})(jQuery);