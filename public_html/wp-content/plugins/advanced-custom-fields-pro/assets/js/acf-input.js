( function( window, undefined ) {
	"use strict";

	/**
	 * Handles managing all events for whatever you plug it into. Priorities for hooks are based on lowest to highest in
	 * that, lowest priority hooks are fired first.
	 */
	var EventManager = function() {
		/**
		 * Maintain a reference to the object scope so our public methods never get confusing.
		 */
		var MethodsAvailable = {
			removeFilter : removeFilter,
			applyFilters : applyFilters,
			addFilter : addFilter,
			removeAction : removeAction,
			doAction : doAction,
			addAction : addAction,
			storage : getStorage
		};

		/**
		 * Contains the hooks that get registered with this EventManager. The array for storage utilizes a "flat"
		 * object literal such that looking up the hook utilizes the native object literal hash.
		 */
		var STORAGE = {
			actions : {},
			filters : {}
		};
		
		function getStorage() {
			
			return STORAGE;
			
		};
		
		/**
		 * Adds an action to the event manager.
		 *
		 * @param action Must contain namespace.identifier
		 * @param callback Must be a valid callback function before this action is added
		 * @param [priority=10] Used to control when the function is executed in relation to other callbacks bound to the same hook
		 * @param [context] Supply a value to be used for this
		 */
		function addAction( action, callback, priority, context ) {
			if( typeof action === 'string' && typeof callback === 'function' ) {
				priority = parseInt( ( priority || 10 ), 10 );
				_addHook( 'actions', action, callback, priority, context );
			}

			return MethodsAvailable;
		}

		/**
		 * Performs an action if it exists. You can pass as many arguments as you want to this function; the only rule is
		 * that the first argument must always be the action.
		 */
		function doAction( /* action, arg1, arg2, ... */ ) {
			var args = Array.prototype.slice.call( arguments );
			var action = args.shift();

			if( typeof action === 'string' ) {
				_runHook( 'actions', action, args );
			}

			return MethodsAvailable;
		}

		/**
		 * Removes the specified action if it contains a namespace.identifier & exists.
		 *
		 * @param action The action to remove
		 * @param [callback] Callback function to remove
		 */
		function removeAction( action, callback ) {
			if( typeof action === 'string' ) {
				_removeHook( 'actions', action, callback );
			}

			return MethodsAvailable;
		}

		/**
		 * Adds a filter to the event manager.
		 *
		 * @param filter Must contain namespace.identifier
		 * @param callback Must be a valid callback function before this action is added
		 * @param [priority=10] Used to control when the function is executed in relation to other callbacks bound to the same hook
		 * @param [context] Supply a value to be used for this
		 */
		function addFilter( filter, callback, priority, context ) {
			if( typeof filter === 'string' && typeof callback === 'function' ) {
				priority = parseInt( ( priority || 10 ), 10 );
				_addHook( 'filters', filter, callback, priority, context );
			}

			return MethodsAvailable;
		}

		/**
		 * Performs a filter if it exists. You should only ever pass 1 argument to be filtered. The only rule is that
		 * the first argument must always be the filter.
		 */
		function applyFilters( /* filter, filtered arg, arg2, ... */ ) {
			var args = Array.prototype.slice.call( arguments );
			var filter = args.shift();

			if( typeof filter === 'string' ) {
				return _runHook( 'filters', filter, args );
			}

			return MethodsAvailable;
		}

		/**
		 * Removes the specified filter if it contains a namespace.identifier & exists.
		 *
		 * @param filter The action to remove
		 * @param [callback] Callback function to remove
		 */
		function removeFilter( filter, callback ) {
			if( typeof filter === 'string') {
				_removeHook( 'filters', filter, callback );
			}

			return MethodsAvailable;
		}

		/**
		 * Removes the specified hook by resetting the value of it.
		 *
		 * @param type Type of hook, either 'actions' or 'filters'
		 * @param hook The hook (namespace.identifier) to remove
		 * @private
		 */
		function _removeHook( type, hook, callback, context ) {
			if ( !STORAGE[ type ][ hook ] ) {
				return;
			}
			if ( !callback ) {
				STORAGE[ type ][ hook ] = [];
			} else {
				var handlers = STORAGE[ type ][ hook ];
				var i;
				if ( !context ) {
					for ( i = handlers.length; i--; ) {
						if ( handlers[i].callback === callback ) {
							handlers.splice( i, 1 );
						}
					}
				}
				else {
					for ( i = handlers.length; i--; ) {
						var handler = handlers[i];
						if ( handler.callback === callback && handler.context === context) {
							handlers.splice( i, 1 );
						}
					}
				}
			}
		}

		/**
		 * Adds the hook to the appropriate storage container
		 *
		 * @param type 'actions' or 'filters'
		 * @param hook The hook (namespace.identifier) to add to our event manager
		 * @param callback The function that will be called when the hook is executed.
		 * @param priority The priority of this hook. Must be an integer.
		 * @param [context] A value to be used for this
		 * @private
		 */
		function _addHook( type, hook, callback, priority, context ) {
			var hookObject = {
				callback : callback,
				priority : priority,
				context : context
			};

			// Utilize 'prop itself' : http://jsperf.com/hasownproperty-vs-in-vs-undefined/19
			var hooks = STORAGE[ type ][ hook ];
			if( hooks ) {
				hooks.push( hookObject );
				hooks = _hookInsertSort( hooks );
			}
			else {
				hooks = [ hookObject ];
			}

			STORAGE[ type ][ hook ] = hooks;
		}

		/**
		 * Use an insert sort for keeping our hooks organized based on priority. This function is ridiculously faster
		 * than bubble sort, etc: http://jsperf.com/javascript-sort
		 *
		 * @param hooks The custom array containing all of the appropriate hooks to perform an insert sort on.
		 * @private
		 */
		function _hookInsertSort( hooks ) {
			var tmpHook, j, prevHook;
			for( var i = 1, len = hooks.length; i < len; i++ ) {
				tmpHook = hooks[ i ];
				j = i;
				while( ( prevHook = hooks[ j - 1 ] ) &&  prevHook.priority > tmpHook.priority ) {
					hooks[ j ] = hooks[ j - 1 ];
					--j;
				}
				hooks[ j ] = tmpHook;
			}

			return hooks;
		}

		/**
		 * Runs the specified hook. If it is an action, the value is not modified but if it is a filter, it is.
		 *
		 * @param type 'actions' or 'filters'
		 * @param hook The hook ( namespace.identifier ) to be ran.
		 * @param args Arguments to pass to the action/filter. If it's a filter, args is actually a single parameter.
		 * @private
		 */
		function _runHook( type, hook, args ) {
			var handlers = STORAGE[ type ][ hook ];
			
			if ( !handlers ) {
				return (type === 'filters') ? args[0] : false;
			}

			var i = 0, len = handlers.length;
			if ( type === 'filters' ) {
				for ( ; i < len; i++ ) {
					args[ 0 ] = handlers[ i ].callback.apply( handlers[ i ].context, args );
				}
			} else {
				for ( ; i < len; i++ ) {
					handlers[ i ].callback.apply( handlers[ i ].context, args );
				}
			}

			return ( type === 'filters' ) ? args[ 0 ] : true;
		}

		// return all of the publicly available methods
		return MethodsAvailable;

	};
	
	window.wp = window.wp || {};
	window.wp.hooks = new EventManager();

} )( window );


var acf;

(function($){
	
	
	/*
	*  exists
	*
	*  This function will return true if a jQuery selection exists
	*
	*  @type	function
	*  @date	8/09/2014
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	(boolean)
	*/
	
	$.fn.exists = function() {
	
		return $(this).length>0;
		
	};
	
	
	/*
	*  outerHTML
	*
	*  This function will return a string containing the HTML of the selected element
	*
	*  @type	function
	*  @date	19/11/2013
	*  @since	5.0.0
	*
	*  @param	$.fn
	*  @return	(string)
	*/
	
	$.fn.outerHTML = function() {
	    
	    return $(this).get(0).outerHTML;
	    
	};
	
	
	acf = {
		
		// vars
		l10n:	{},
		o:		{},
		
		
		/*
		*  update
		*
		*  This function will update a value found in acf.o
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	k (string) the key
		*  @param	v (mixed) the value
		*  @return	n/a
		*/
		
		update: function( k, v ){
				
			this.o[ k ] = v;
			
		},
		
		
		/*
		*  get
		*
		*  This function will return a value found in acf.o
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	k (string) the key
		*  @return	v (mixed) the value
		*/
		
		get: function( k ){
			
			if( typeof this.o[ k ] !== 'undefined' ) {
				
				return this.o[ k ];
				
			}
			
			return null;
			
		},
		
		
		/*
		*  _e
		*
		*  This functiln will return a string found in acf.l10n
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	k1 (string) the first key to look for
		*  @param	k2 (string) the second key to look for
		*  @return	string (string)
		*/
		
		_e: function( k1, k2 ){
			
			// defaults
			k2 = k2 || false;
			
			
			// get context
			var string = this.l10n[ k1 ] || '';
			
			
			// get string
			if( k2 ) {
			
				string = string[ k2 ] || '';
				
			}
			
			
			// return
			return string;
			
		},
		
		
		/*
		*  add_action
		*
		*  This function uses wp.hooks to mimics WP add_action
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	
		*  @return
		*/
		
		add_action: function() {
			
			// vars
			var a = arguments[0].split(' '),
				l = a.length;
			
			
			// loop
			for( var i = 0; i < l; i++) {
				
/*
				// allow for special actions
				if( a[i].indexOf('initialize') !== -1 ) {
					
					a.push( a[i].replace('initialize', 'ready') );
					a.push( a[i].replace('initialize', 'append') );
					l = a.length;
					
					continue;
				}
*/
				
				
				// prefix action
				arguments[0] = 'acf/' + a[i];
			
			
				// add
				wp.hooks.addAction.apply(this, arguments);
					
			}
			
			
			// return
			return this;
			
		},
		
		
		/*
		*  remove_action
		*
		*  This function uses wp.hooks to mimics WP remove_action
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	
		*  @return
		*/
		
		remove_action: function() {
			
			// prefix action
			arguments[0] = 'acf/' + arguments[0];
			
			wp.hooks.removeAction.apply(this, arguments);
			
			return this;
			
		},
		
		
		/*
		*  do_action
		*
		*  This function uses wp.hooks to mimics WP do_action
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	
		*  @return
		*/
		
		do_action: function() { //console.log('acf.do_action(%o)', arguments);
			
			// prefix action
			arguments[0] = 'acf/' + arguments[0];
			
			wp.hooks.doAction.apply(this, arguments);
			
			return this;
			
		},
		
		
		/*
		*  add_filter
		*
		*  This function uses wp.hooks to mimics WP add_filter
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	
		*  @return
		*/
		
		add_filter: function() {
			
			// prefix action
			arguments[0] = 'acf/' + arguments[0];
			
			wp.hooks.addFilter.apply(this, arguments);
			
			return this;
			
		},
		
		
		/*
		*  remove_filter
		*
		*  This function uses wp.hooks to mimics WP remove_filter
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	
		*  @return
		*/
		
		remove_filter: function() {
			
			// prefix action
			arguments[0] = 'acf/' + arguments[0];
			
			wp.hooks.removeFilter.apply(this, arguments);
			
			return this;
			
		},
		
		
		/*
		*  apply_filters
		*
		*  This function uses wp.hooks to mimics WP apply_filters
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	
		*  @return
		*/
		
		apply_filters: function() { //console.log('acf.apply_filters(%o)', arguments);
			
			// prefix action
			arguments[0] = 'acf/' + arguments[0];
			
			return wp.hooks.applyFilters.apply(this, arguments);
			
		},
		
		
		/*
		*  get_selector
		*
		*  This function will return a valid selector for finding a field object
		*
		*  @type	function
		*  @date	15/01/2015
		*  @since	5.1.5
		*
		*  @param	s (string)
		*  @return	(string)
		*/
		
		get_selector: function( s ) {
			
			// defaults
			s = s || '';
			
			
			// vars
			var selector = '.acf-field';
			
			
			// compatibility with object
			if( $.isPlainObject(s) ) {
				
				if( $.isEmptyObject(s) ) {
				
					s = '';
					
				} else {
					
					for( k in s ) { s = s[k]; break; }
					
				}
				
			}


			// search
			if( s ) {
				
				// append
				selector += '-' + s;
				
				
				// replace underscores (split/join replaces all and is faster than regex!)
				selector = selector.split('_').join('-');
				
				
				// remove potential double up
				selector = selector.split('field-field-').join('field-');
			
			}
			
			
			// return
			return selector;
			
		},
		
		
		/*
		*  get_fields
		*
		*  This function will return a jQuery selection of fields
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	args (object)
		*  @param	$el (jQuery) element to look within
		*  @param	all (boolean) return all fields or allow filtering (for repeater)
		*  @return	$fields (jQuery)
		*/
		
		get_fields: function( s, $el, all ){
			
			// debug
			//console.log( 'acf.get_fields(%o, %o, %o)', args, $el, all );
			//console.time("acf.get_fields");
			
			
			// defaults
			s = s || '';
			$el = $el || false;
			all = all || false;
			
			
			// vars
			var selector = this.get_selector(s);
			
			
			// get child fields
			var $fields = $( selector, $el );
			
			
			// append context to fields if also matches selector.
			// * Required for field group 'change_filed_type' append $tr to work
			if( $el !== false ) {
				
				$el.each(function(){
					
					if( $(this).is(selector) ) {
					
						$fields = $fields.add( $(this) );
						
					}
					
				});
				
			}
			
			
			// filter out fields
			if( !all ) {
				
				$fields = acf.apply_filters('get_fields', $fields);
								
			}
			
			
			//console.log('get_fields(%o, %o, %o) %o', s, $el, all, $fields);
			//console.log('acf.get_fields(%o):', this.get_selector(s) );
			//console.timeEnd("acf.get_fields");
			
			
			// return
			return $fields;
							
		},
		
		
		/*
		*  get_field
		*
		*  This function will return a jQuery selection based on a field key
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	field_key (string)
		*  @param	$el (jQuery) element to look within
		*  @return	$field (jQuery)
		*/
		
		get_field: function( s, $el ){
			
			// defaults
			s = s || '';
			$el = $el || false;
			
			
			// get fields
			var $fields = this.get_fields(s, $el, true);
			
			
			// check if exists
			if( $fields.exists() ) {
			
				return $fields.first();
				
			}
			
			
			// return
			return false;
			
		},
		
		
		/*
		*  get_closest_field
		*
		*  This function will return the closest parent field
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$el (jQuery) element to start from
		*  @param	args (object)
		*  @return	$field (jQuery)
		*/
		
		get_closest_field : function( $el, s ){
			
			// defaults
			s = s || '';
			
			
			// return
			return $el.closest( this.get_selector(s) );
			
		},
		
		
		/*
		*  get_field_wrap
		*
		*  This function will return the closest parent field
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$el (jQuery) element to start from
		*  @return	$field (jQuery)
		*/
		
		get_field_wrap: function( $el ){
			
			return $el.closest( this.get_selector() );
			
		},
		
		
		/*
		*  get_field_key
		*
		*  This function will return the field's key
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$field (jQuery)
		*  @return	(string)
		*/
		
		get_field_key: function( $field ){
		
			return $field.data('key');
			
		},
		
		
		/*
		*  get_field_type
		*
		*  This function will return the field's type
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$field (jQuery)
		*  @return	(string)
		*/
		
		get_field_type: function( $field ){
		
			return $field.data('type');
			
		},
		
		
		/*
		*  get_data
		*
		*  This function will return attribute data for a given elemnt
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$el (jQuery)
		*  @param	name (mixed)
		*  @return	(mixed)
		*/
		
		get_data: function( $el, name ){
			
			//console.log('get_data(%o, %o)', name, $el);
			
			
			// get all datas
			if( typeof name === 'undefined' ) {
				
				return $el.data();
				
			}
			
			
			// return
			return $el.data(name);
							
		},
		
		
		/*
		*  get_uniqid
		*
		*  This function will return a unique string ID
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	prefix (string)
		*  @param	more_entropy (boolean)
		*  @return	(string)
		*/
		
		get_uniqid : function( prefix, more_entropy ){
		
			// + original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
			// + revised by: Kankrelune (http://www.webfaktory.info/)
			// % note 1: Uses an internal counter (in php_js global) to avoid collision
			// * example 1: uniqid();
			// * returns 1: 'a30285b160c14'
			// * example 2: uniqid('foo');
			// * returns 2: 'fooa30285b1cd361'
			// * example 3: uniqid('bar', true);
			// * returns 3: 'bara20285b23dfd1.31879087'
			if (typeof prefix === 'undefined') {
				prefix = "";
			}
			
			var retId;
			var formatSeed = function (seed, reqWidth) {
				seed = parseInt(seed, 10).toString(16); // to hex str
				if (reqWidth < seed.length) { // so long we split
					return seed.slice(seed.length - reqWidth);
				}
				if (reqWidth > seed.length) { // so short we pad
					return Array(1 + (reqWidth - seed.length)).join('0') + seed;
				}
				return seed;
			};
			
			// BEGIN REDUNDANT
			if (!this.php_js) {
				this.php_js = {};
			}
			// END REDUNDANT
			if (!this.php_js.uniqidSeed) { // init seed with big random int
				this.php_js.uniqidSeed = Math.floor(Math.random() * 0x75bcd15);
			}
			this.php_js.uniqidSeed++;
			
			retId = prefix; // start with prefix, add current milliseconds hex string
			retId += formatSeed(parseInt(new Date().getTime() / 1000, 10), 8);
			retId += formatSeed(this.php_js.uniqidSeed, 5); // add seed hex string
			if (more_entropy) {
				// for more entropy we add a float lower to 10
				retId += (Math.random() * 10).toFixed(8).toString();
			}
			
			return retId;
			
		},
		
		
		/*
		*  serialize_form
		*
		*  This function will create an object of data containing all form inputs within an element
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$el (jQuery selection)
		*  @return	$post_id (int)
		*/
		
		serialize_form : function( $el ){
			
			// vars
			var data = {},
				names = {};
			
			
			// selector
			$selector = $el.find('select, textarea, input');
			
			
			// populate data
			$.each( $selector.serializeArray(), function( i, pair ) {
				
				// initiate name
				if( pair.name.slice(-2) === '[]' ) {
					
					// remove []
					pair.name = pair.name.replace('[]', '');
					
					
					// initiate counter
					if( typeof names[ pair.name ] === 'undefined'){
						
						names[ pair.name ] = -1;
					}
					
					
					// increase counter
					names[ pair.name ]++;
					
					
					// add key
					pair.name += '[' + names[ pair.name ] +']';
				}
				
				
				// append to data
				data[ pair.name ] = pair.value;
				
			});
			
			
			// return
			return data;
			
		},
		
		serialize: function( $el ){
			
			return this.serialize_form( $el );
			
		},
		
		
		/*
		*  remove_tr
		*
		*  This function will remove a tr element with animation
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$tr (jQuery selection)
		*  @param	callback (function) runs on complete
		*  @return	n/a
		*/
		
		remove_tr : function( $tr, callback ){
			
			// vars
			var height = $tr.height(),
				children = $tr.children().length;
			
			
			// add class
			$tr.addClass('acf-remove-element');
			
			
			// after animation
			setTimeout(function(){
				
				// remove class
				$tr.removeClass('acf-remove-element');
				
				
				// vars
				$tr.html('<td style="padding:0; height:' + height + 'px" colspan="' + children + '"></td>');
				
				
				$tr.children('td').animate({ height : 0}, 250, function(){
					
					$tr.remove();
					
					if( typeof(callback) == 'function' ) {
					
						callback();
					
					}
					
					
				});
				
					
			}, 250);
			
		},
		
		
		/*
		*  remove_el
		*
		*  This function will remove an element with animation
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$el (jQuery selection)
		*  @param	callback (function) runs on complete
		*  @param	end_height (int)
		*  @return	n/a
		*/
		
		remove_el : function( $el, callback, end_height ){
			
			// defaults
			end_height = end_height || 0;
			
			
			// set layout
			$el.css({
				height		: $el.height(),
				width		: $el.width(),
				position	: 'absolute',
				//padding		: 0
			});
			
			
			// wrap field
			$el.wrap( '<div class="acf-temp-wrap" style="height:' + $el.outerHeight(true) + 'px"></div>' );
			
			
			// fade $el
			$el.animate({ opacity : 0 }, 250);
			
			
			// remove
			$el.parent('.acf-temp-wrap').animate({ height : end_height }, 250, function(){
				
				$(this).remove();
				
				if( typeof(callback) == 'function' ) {
				
					callback();
				
				}
				
			});
			
			
		},
		
		
		/*
		*  isset
		*
		*  This function will return true if an object key exists
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	(object)
		*  @param	key1 (string)
		*  @param	key2 (string)
		*  @param	...
		*  @return	(boolean)
		*/
		
		isset : function(){
			
			var a = arguments,
		        l = a.length,
		        c = null,
		        undef;
			
		    if (l === 0) {
		        throw new Error('Empty isset');
		    }
			
			c = a[0];
			
		    for (i = 1; i < l; i++) {
		    	
		        if (a[i] === undef || c[ a[i] ] === undef) {
		            return false;
		        }
		        
		        c = c[ a[i] ];
		        
		    }
		    
		    return true;	
			
		},
		
		
		/*
		*  maybe_get
		*
		*  This function will attempt to return a value and return null if not possible
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	obj (object) the array to look within
		*  @param	key (key) the array key to look for. Nested values may be found using '/'
		*  @param	value (mixed) the value returned if not found
		*  @return	(mixed)
		*/
		
		maybe_get: function( obj, key, value ){
			
			// default
			if( typeof value == 'undefined' ) value = null;
						
			
			// convert type to string and split
			keys = String(key).split('.');
			
			
			// loop through keys
			for( var i in keys ) {
				
				// vars
				var key = keys[i];
				
				
				// bail ealry if not set
				if( typeof obj[ key ] === 'undefined' ) {
					
					return value;
					
				}
				
				
				// update obj
				obj = obj[ key ];
				
			}
			
			
			// return
			return obj;
			
		},
		
		
		/*
		*  open_popup
		*
		*  This function will create and open a popup modal
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	args (object)
		*  @return	n/a
		*/
		
		open_popup : function( args ){
			
			// vars
			$popup = $('body > #acf-popup');
			
			
			// already exists?
			if( $popup.exists() ) {
			
				return update_popup(args);
				
			}
			
			
			// template
			var tmpl = [
				'<div id="acf-popup">',
					'<div class="acf-popup-box acf-box">',
						'<div class="title"><h3></h3><a href="#" class="acf-icon -cancel grey acf-close-popup"></a></div>',
						'<div class="inner"></div>',
						'<div class="loading"><i class="acf-loading"></i></div>',
					'</div>',
					'<div class="bg"></div>',
				'</div>'
			].join('');
			
			
			// append
			$('body').append( tmpl );
			
			
			$('#acf-popup').on('click', '.bg, .acf-close-popup', function( e ){
				
				e.preventDefault();
				
				acf.close_popup();
				
			});
			
			
			// update
			return this.update_popup(args);
			
		},
		
		
		/*
		*  update_popup
		*
		*  This function will update the content within a popup modal
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	args (object)
		*  @return	n/a
		*/
		
		update_popup : function( args ){
			
			// vars
			$popup = $('#acf-popup');
			
			
			// validate
			if( !$popup.exists() )
			{
				return false
			}
			
			
			// defaults
			args = $.extend({}, {
				title	: '',
				content : '',
				width	: 0,
				height	: 0,
				loading : false
			}, args);
			
			
			if( args.title ) {
			
				$popup.find('.title h3').html( args.title );
			
			}
			
			if( args.content ) {
				
				$inner = $popup.find('.inner:first');
				
				$inner.html( args.content );
				
				acf.do_action('append', $inner);
				
				// update height
				$inner.attr('style', 'position: relative;');
				args.height = $inner.outerHeight();
				$inner.removeAttr('style');
				
			}
			
			if( args.width ) {
			
				$popup.find('.acf-popup-box').css({
					'width'			: args.width,
					'margin-left'	: 0 - (args.width / 2),
				});
				
			}
			
			if( args.height ) {
				
				// add h3 height (44)
				args.height += 44;
				
				$popup.find('.acf-popup-box').css({
					'height'		: args.height,
					'margin-top'	: 0 - (args.height / 2),
				});	
				
			}
			
			
			if( args.loading ) {
			
				$popup.find('.loading').show();
				
			} else {
			
				$popup.find('.loading').hide();
				
			}
			
			return $popup;
		},
		
		
		/*
		*  close_popup
		*
		*  This function will close and remove a popup modal
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	n/a
		*  @return	n/a
		*/
		
		close_popup : function(){
			
			// vars
			$popup = $('#acf-popup');
			
			
			// already exists?
			if( $popup.exists() )
			{
				$popup.remove();
			}
			
		},
		
		
		/*
		*  update_user_setting
		*
		*  This function will send an AJAX request to update a user setting
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$post_id (int)
		*  @return	$post_id (int)
		*/
		
		update_user_setting : function( name, value ) {
			
			// ajax
			$.ajax({
		    	url			: acf.get('ajaxurl'),
				dataType	: 'html',
				type		: 'post',
				data		: acf.prepare_for_ajax({
					'action'	: 'acf/update_user_setting',
					'name'		: name,
					'value'		: value
				})
			});
			
		},
		
		
		/*
		*  prepare_for_ajax
		*
		*  This function will prepare data for an AJAX request
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	args (object)
		*  @return	args
		*/
		
		prepare_for_ajax : function( args ) {
			
			// nonce
			args.nonce = acf.get('nonce');
			
			
			// filter for 3rd party customization
			args = acf.apply_filters('prepare_for_ajax', args);	
			
			
			// return
			return args;
			
		},
		
		
		/*
		*  is_ajax_success
		*
		*  This function will return true for a successful WP AJAX response
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	json (object)
		*  @return	(boolean)
		*/
		
		is_ajax_success : function( json ) {
			
			if( json && json.success ) {
				
				return true;
				
			}
			
			return false;
			
		},
		
		
		/*
		*  get_ajax_message
		*
		*  This function will return an object containing error/message information
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	json (object)
		*  @return	(boolean)
		*/
		
		get_ajax_message: function( json ) {
			
			// vars
			var message = {
				text: '',
				type: 'error'
			};
			
			
			// bail early if no json
			if( !json ) {
				
				return message;
				
			}
			
			
			// PHP error (too may themes will have warnings / errors. Don't show these in ACF taxonomy popup)
/*
			if( typeof json === 'string' ) {
				
				message.text = json;
				return message;
					
			}
*/
			
			
			// success
			if( json.success ) {
				
				message.type = 'success';

			}
			
						
			// message
			if( json.data && json.data.message ) {
				
				message.text = json.data.message;
				
			}
			
			
			// error
			if( json.data && json.data.error ) {
				
				message.text = json.data.error;
				
			}
			
			
			// return
			return message;
			
		},
		
		
		/*
		*  is_in_view
		*
		*  This function will return true if a jQuery element is visible in browser
		*
		*  @type	function
		*  @date	8/09/2014
		*  @since	5.0.0
		*
		*  @param	$el (jQuery)
		*  @return	(boolean)
		*/
		
		is_in_view: function( $el ) {
			
			// vars
		    var elemTop = $el.offset().top,
		    	elemBottom = elemTop + $el.height();
		    
		    
			// bail early if hidden
			if( elemTop === elemBottom ) {
				
				return false;
				
			}
			
			
			// more vars
			var docViewTop = $(window).scrollTop(),
				docViewBottom = docViewTop + $(window).height();
			
			
			// return
		    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
					
		},
		
		
		/*
		*  val
		*
		*  This function will update an elements value and trigger the change event if different
		*
		*  @type	function
		*  @date	16/10/2014
		*  @since	5.0.9
		*
		*  @param	$el (jQuery)
		*  @param	val (mixed)
		*  @return	n/a
		*/
		
		val: function( $el, val ){
			
			// vars
			var orig = $el.val();
			
			
			// update value
			$el.val( val );
			
			
			// trigger change
			if( val != orig ) {
				
				$el.trigger('change');
				
			}
			
		},
		
		
		/*
		*  str_replace
		*
		*  This function will perform a str replace similar to php function str_replace
		*
		*  @type	function
		*  @date	1/05/2015
		*  @since	5.2.3
		*
		*  @param	$search (string)
		*  @param	$replace (string)
		*  @param	$subject (string)
		*  @return	(string)
		*/
		
		str_replace: function( search, replace, subject ) {
			
			return subject.split(search).join(replace);
			
		},
		
		
		/*
		*  str_sanitize
		*
		*  description
		*
		*  @type	function
		*  @date	4/06/2015
		*  @since	5.2.3
		*
		*  @param	$post_id (int)
		*  @return	$post_id (int)
		*/
		
		str_sanitize: function( string ) {
			
			// vars
			var string2 = '',
				replace = {
				'æ': 'a',
				'å': 'a',
				'á': 'a',
				'ä': 'a',
				'č': 'c',
				'ď': 'd',
				'è': 'e',
				'é': 'e',
				'ě': 'e',
				'ë': 'e',
				'í': 'i',
				'ĺ': 'l',
				'ľ': 'l',
				'ň': 'n',
				'ø': 'o',
				'ó': 'o',
				'ô': 'o',
				'ő': 'o',
				'ö': 'o',
				'ŕ': 'r',
				'š': 's',
				'ť': 't',
				'ú': 'u',
				'ů': 'u',
				'ű': 'u',
				'ü': 'u',
				'ý': 'y',
				'ř': 'r',
				'ž': 'z',
				' ': '_',
				'\'': '',
				'?': '',
				'/': '',
				'\\': '',
				'.': '',
				',': '',
				'>': '',
				'<': '',
				'"': '',
				'[': '',
				']': '',
				'|': '',
				'{': '',
				'}': '',
				'(': '',
				')': ''
			};
			
			
			// lowercase
			string = string.toLowerCase();
			
			
			// loop through characters
			for( i = 0; i < string.length; i++ ) {
				
				// character
				var c = string.charAt(i);
				
				
				// override c with replacement
				if( typeof replace[c] !== 'undefined' ) {
					
					c = replace[c];
						
				}
				
				
				// append
				string2 += c;
					
			}
			
			
			// return
			return string2;
				
		},
		
		
		/*
		*  render_select
		*
		*  This function will update a select field with new choices
		*
		*  @type	function
		*  @date	8/04/2014
		*  @since	5.0.0
		*
		*  @param	$select
		*  @param	choices
		*  @return	n/a
		*/
		
		render_select: function( $select, choices ){
			
			// vars
			var value = $select.val();
			
			
			// clear choices
			$select.html('');
			
			
			// bail early if no choices
			if( !choices ) {
				
				return;
				
			}
			
			
			// populate choices
			$.each(choices, function( i, item ){
				
				// vars
				var $optgroup = $select;
				
				
				// add group
				if( item.group ) {
					
					$optgroup = $select.find('optgroup[label="' + item.group + '"]');
					
					if( !$optgroup.exists() ) {
						
						$optgroup = $('<optgroup label="' + item.group + '"></optgroup>');
						
						$select.append( $optgroup );
						
					}
					
				}
				
				
				// append select
				$optgroup.append( '<option value="' + item.value + '">' + item.label + '</option>' );
				
				
				// selectedIndex
				if( value == item.value ) {
					
					 $select.prop('selectedIndex', i);
					 
				}
				
			});
			
		},
		
		
		/*
		*  duplicate
		*
		*  This function will duplicate and return an element
		*
		*  @type	function
		*  @date	22/08/2015
		*  @since	5.2.3
		*
		*  @param	$el (jQuery) object to be duplicated
		*  @param	attr (string) attrbute name where $el id can be found
		*  @return	$el2 (jQuery)
		*/
		
		duplicate: function( $el, attr ){
			
			//console.time('duplicate');
			
			
			// defaults
			attr = attr || 'data-id';
			
			
			// vars
			find = $el.attr(attr);
			replace = acf.get_uniqid();
			
			
			// allow acf to modify DOM
			// fixes bug where select field option is not selected
			acf.do_action('before_duplicate', $el);
			
			
			// clone
			var	$el2 = $el.clone();
			
			
			// remove acf-clone (may be a clone)
			$el2.removeClass('acf-clone');
			
			
			// remove JS functionality
			acf.do_action('remove', $el2);
			
			
			// find / replace
			if( typeof find !== 'undefined' ) {
				
				// replcae data attribute
				$el2.attr(attr, replace);
				
				
				// replace ids
				$el2.find('[id*="' + find + '"]').each(function(){	
				
					$(this).attr('id', $(this).attr('id').replace(find, replace) );
					
				});
				
				
				// replace names
				$el2.find('[name*="' + find + '"]').each(function(){	
				
					$(this).attr('name', $(this).attr('name').replace(find, replace) );
					
				});
				
				
				// replace label for
				$el2.find('label[for*="' + find + '"]').each(function(){
				
					$(this).attr('for', $(this).attr('for').replace(find, replace) );
					
				});
				
			}
			
			
			// remove ui-sortable
			$el2.find('.ui-sortable').removeClass('ui-sortable');
			
			
			// allow acf to modify DOM
			acf.do_action('after_duplicate', $el, $el2 );
			
			
			// append
			$el.after( $el2 );
			
			
			// add JS functionality
			// - allow element to be moved into a visible position before fire action
			setTimeout(function(){
				
				acf.do_action('append', $el2);
				
			}, 1);
			
			
			//console.timeEnd('duplicate');
			
			
			// return
			return $el2;
			
		},
		
		decode: function( string ){
			
			return $('<div/>').html( string ).text();
			
		},
		
		
		/*
		*  parse_args
		*
		*  This function will merge together defaults and args much like the WP wp_parse_args function
		*
		*  @type	function
		*  @date	11/04/2016
		*  @since	5.3.8
		*
		*  @param	args (object)
		*  @param	defaults (object)
		*  @return	args
		*/
		
		parse_args: function( args, defaults ) {
			
			return $.extend({}, defaults, args);
			
		}
		
	};
	
	
	/*
	*  acf.model
	*
	*  This model acts as a scafold for action.event driven modules
	*
	*  @type	object
	*  @date	8/09/2014
	*  @since	5.0.0
	*
	*  @param	(object)
	*  @return	(object)
	*/
	
	acf.model = {
		
		// vars
		actions:	{},
		filters:	{},
		events:		{},
		
		extend: function( args ){
			
			// extend
			var model = $.extend( {}, this, args );
			
			
			// setup actions
			$.each(model.actions, function( name, callback ){
				
				model._add_action( name, callback );
			
			});
			
			
			// setup filters
			$.each(model.filters, function( name, callback ){
				
				model._add_filter( name, callback );
			
			});
			
			
			// setup events
			$.each(model.events, function( name, callback ){
				
				model._add_event( name, callback );
				
			});
			
			
			// return
			return model;
			
		},
		
		_add_action: function( name, callback ) {
			
			// split
			var model = this,
				data = name.split(' ');
			
			
			// add missing priority
			var name = data[0] || '',
				priority = data[1] || 10;
			
			
			// add action
			acf.add_action(name, model[ callback ], priority, model);
			
		},
		
		_add_filter: function( name, callback ) {
			
			// split
			var model = this,
				data = name.split(' ');
			
			
			// add missing priority
			var name = data[0] || '',
				priority = data[1] || 10;
			
			
			// add action
			acf.add_filter(name, model[ callback ], priority, model);
			
		},
		
		_add_event: function( name, callback ) {
			
			// vars
			var model = this,
				event = name.substr(0,name.indexOf(' ')),
				selector = name.substr(name.indexOf(' ')+1);
			
			
			// add event
			$(document).on(event, selector, function( e ){
				
				// append $el to event object
				e.$el = $(this);
				
				
				// event
				if( typeof model.event === 'function' ) {
					
					e = model.event( e );
					
				}
				
				
				// callback
				model[ callback ].apply(model, [e]);
				
			});
			
		},
		
		get: function( name, value ){
			
			// defaults
			value = value || null;
			
			
			// get
			if( typeof this[ name ] !== 'undefined' ) {
				
				value = this[ name ];
					
			}
			
			
			// return
			return value;
			
		},
		
		
		set: function( name, value ){
			
			// set
			this[ name ] = value;
			
			
			// function for 3rd party
			if( typeof this[ '_set_' + name ] === 'function' ) {
				
				this[ '_set_' + name ].apply(this);
				
			}
			
			
			// return for chaining
			return this;
			
		}
		
	};
	
	
	/*
	*  field
	*
	*  This model sets up many of the field's interactions
	*
	*  @type	function
	*  @date	21/02/2014
	*  @since	3.5.1
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	acf.field = acf.model.extend({
		
		// vars
		type:		'',
		o:			{},
		$field:		null,
		
		_add_action: function( name, callback ) {
			
			// vars
			var model = this;
			
			
			// update name
			name = name + '_field/type=' + model.type;
			
			
			// add action
			acf.add_action(name, function( $field ){
				
				// focus
				model.set('$field', $field);
				
				
				// callback
				model[ callback ].apply(model, arguments);
				
			});
			
		},
		
		_add_filter: function( name, callback ) {
			
			// vars
			var model = this;
			
			
			// update name
			name = name + '_field/type=' + model.type;
			
			
			// add action
			acf.add_filter(name, function( $field ){
				
				// focus
				model.set('$field', $field);
				
				
				// callback
				model[ callback ].apply(model, arguments);
				
			});
			
		},
		
		_add_event: function( name, callback ) {
			
			// vars
			var model = this,
				event = name.substr(0,name.indexOf(' ')),
				selector = name.substr(name.indexOf(' ')+1),
				context = acf.get_selector(model.type);
			
			
			// add event
			$(document).on(event, context + ' ' + selector, function( e ){
				
				// append $el to event object
				e.$el = $(this);
				e.$field = acf.get_closest_field(e.$el, model.type);
				
				
				// focus
				model.set('$field', e.$field);
				
				
				// callback
				model[ callback ].apply(model, [e]);
				
			});
			
		},
		
		_set_$field: function(){
			
			// callback
			if( typeof this.focus === 'function' ) {
				
				this.focus();
				
			}
			
		},
		
		// depreciated
		doFocus: function( $field ){
			
			return this.set('$field', $field);
			
		}
		
	});
	
	
	/*
	*  field
	*
	*  This model fires actions and filters for registered fields
	*
	*  @type	function
	*  @date	21/02/2014
	*  @since	3.5.1
	*
	*  @param	n/a
	*  @return	n/a
	*/
	
	acf.fields = acf.model.extend({
		
		actions: {
			'prepare'			: '_prepare',
			'prepare_field'		: '_prepare_field',
			'ready'				: '_ready',
			'ready_field'		: '_ready_field',
			'append'			: '_append',
			'append_field'		: '_append_field',
			'load'				: '_load',
			'load_field'		: '_load_field',
			'remove'			: '_remove',
			'remove_field'		: '_remove_field',
			'sortstart'			: '_sortstart',
			'sortstart_field'	: '_sortstart_field',
			'sortstop'			: '_sortstop',
			'sortstop_field'	: '_sortstop_field',
			'show'				: '_show',
			'show_field'		: '_show_field',
			'hide'				: '_hide',
			'hide_field'		: '_hide_field',
		},
		
		// prepare
		_prepare: function( $el ){
		
			acf.get_fields('', $el).each(function(){
				
				acf.do_action('prepare_field', $(this));
				
			});
			
		},
		
		_prepare_field: function( $el ){
			
			acf.do_action('prepare_field/type=' + $el.data('type'), $el);
			
		},
		
		// ready
		_ready: function( $el ){
		
			acf.get_fields('', $el).each(function(){
				
				acf.do_action('ready_field', $(this));
				
			});
			
		},
		
		_ready_field: function( $el ){
			
			acf.do_action('ready_field/type=' + $el.data('type'), $el);
			
		},
		
		// append
		_append: function( $el ){
		
			acf.get_fields('', $el).each(function(){
				
				acf.do_action('append_field', $(this));
				
			});
			
		},
		
		_append_field: function( $el ){
		
			acf.do_action('append_field/type=' + $el.data('type'), $el);
			
		},
		
		// load
		_load: function( $el ){
		
			acf.get_fields('', $el).each(function(){
				
				acf.do_action('load_field', $(this));
				
			});
			
		},
		
		_load_field: function( $el ){
		
			acf.do_action('load_field/type=' + $el.data('type'), $el);
			
		},
		
		// remove
		_remove: function( $el ){
		
			acf.get_fields('', $el).each(function(){
				
				acf.do_action('remove_field', $(this));
				
			});
			
		},
		
		_remove_field: function( $el ){
		
			acf.do_action('remove_field/type=' + $el.data('type'), $el);
			
		},
		
		// sortstart
		_sortstart: function( $el, $placeholder ){
		
			acf.get_fields('', $el).each(function(){
				
				acf.do_action('sortstart_field', $(this), $placeholder);
				
			});
			
		},
		
		_sortstart_field: function( $el, $placeholder ){
		
			acf.do_action('sortstart_field/type=' + $el.data('type'), $el, $placeholder);
			
		},
		
		// sortstop
		_sortstop: function( $el, $placeholder ){
		
			acf.get_fields('', $el).each(function(){
				
				acf.do_action('sortstop_field', $(this), $placeholder);
				
			});
			
		},
		
		_sortstop_field: function( $el, $placeholder ){
		
			acf.do_action('sortstop_field/type=' + $el.data('type'), $el, $placeholder);
			
		},
		
		
		// hide
		_hide: function( $el, context ){
		
			acf.get_fields('', $el).each(function(){
				
				acf.do_action('hide_field', $(this), context);
				
			});
			
		},
		
		_hide_field: function( $el, context ){
		
			acf.do_action('hide_field/type=' + $el.data('type'), $el, context);
			
		},
		
		// show
		_show: function( $el, context ){
		
			acf.get_fields('', $el).each(function(){
				
				acf.do_action('show_field', $(this), context);
				
			});
			
		},
		
		_show_field: function( $el, context ){
		
			acf.do_action('show_field/type=' + $el.data('type'), $el, context);
			
		}
		
	});
	
	
	/*
	*  ready
	*
	*  description
	*
	*  @type	function
	*  @date	19/02/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	$(document).ready(function(){
		
		// action for 3rd party customization
		acf.do_action('ready', $('body'));
		
	});
	
	
	/*
	*  load
	*
	*  description
	*
	*  @type	function
	*  @date	19/02/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	$(window).on('load', function(){
		
		// action for 3rd party customization
		acf.do_action('load', $('body'));
		
	});
	
	
	/*
	*  layout
	*
	*  This model handles the width layout for fields
	*
	*  @type	function
	*  @date	21/02/2014
	*  @since	3.5.1
	*
	*  @param	n/a
	*  @return	n/a
	*/
		
	acf.layout = acf.model.extend({
		
		active: 0,
		
		actions: {
			'refresh': 	'refresh',
		},
		
		refresh: function( $el ){
			
			//console.time('acf.width.render');
			
			// defaults
			$el = $el || false;
			
			
			// loop over visible fields
			$('.acf-fields:visible', $el).each(function(){
				
				// vars
				var $els = $(),
					top = 0,
					height = 0,
					cell = -1;
				
				
				// get fields
				var $fields = $(this).children('.acf-field[data-width]:visible');
				
				
				// bail early if no fields
				if( !$fields.exists() ) {
					
					return;
					
				}
				
				
				// reset fields
				$fields.removeClass('acf-r0 acf-c0').css({'min-height': 0});
				
				
				$fields.each(function( i ){
					
					// vars
					var $el = $(this),
						this_top = $el.position().top;
					
					
					// set top
					if( i == 0 ) {
						
						top = this_top;
						
					}
					
					
					// detect new row
					if( this_top != top ) {
						
						// set previous heights
						$els.css({'min-height': (height+1)+'px'});
						
						// reset
						$els = $();
						top = $el.position().top; // don't use variable as this value may have changed due to min-height css
						height = 0;
						cell = -1;
						
					}
					
											
					// increase
					cell++;
				
					// set height
					height = ($el.outerHeight() > height) ? $el.outerHeight() : height;
					
					// append
					$els = $els.add( $el );
					
					// add classes
					if( this_top == 0 ) {
						
						$el.addClass('acf-r0');
						
					} else if( cell == 0 ) {
						
						$el.addClass('acf-c0');
						
					}
					
				});
				
				
				// clean up
				if( $els.exists() ) {
					
					$els.css({'min-height': (height+1)+'px'});
					
				}
				
				
			});
			
			//console.timeEnd('acf.width.render');

			
		}
		
	});
	
	
	/*
	*  Force revisions
	*
	*  description
	*
	*  @type	function
	*  @date	19/02/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	$(document).on('change', '.acf-field input, .acf-field textarea, .acf-field select', function(){
		
		// preview hack
		if( $('#acf-form-data input[name="_acfchanged"]').exists() ) {
		
			$('#acf-form-data input[name="_acfchanged"]').val(1);
			
		}
		
		
		// action for 3rd party customization
		acf.do_action('change', $(this));
		
	});
	
	
	/*
	*  preventDefault helper
	*
	*  This function will prevent default of any link with an href of #
	*
	*  @type	function
	*  @date	24/07/2014
	*  @since	5.0.0
	*
	*  @param	$post_id (int)
	*  @return	$post_id (int)
	*/
	
	$(document).on('click', '.acf-field a[href="#"]', function( e ){
		
		e.preventDefault();
		
	});
	
	
	/*
	*  unload
	*
	*  This model handles the unload prompt
	*
	*  @type	function
	*  @date	21/02/2014
	*  @since	3.5.1
	*
	*  @param	n/a
	*  @return	n/a
	*/
		
	acf.unload = acf.model.extend({
		
		active: 1,
		changed: 0,
		
		filters: {
			'validation_complete': 'validation_complete'
		},
		
		actions: {
			'change':	'on',
			'submit':	'off'
		},
		
		events: {
			'submit form':	'off',
		},
		
		validation_complete: function( json, $form ){
			
			if( json && json.errors ) {
				
				this.on();
				
			}
			
			// return
			return json;
			
		},
		
		on: function(){
			
			// bail ealry if already changed (or not active)
			if( this.changed || !this.active ) {
				
				return;
				
			}
			
			
			// update 
			this.changed = 1;
			
			
			// add event
			$(window).on('beforeunload', this.unload);
			
		},
		
		off: function(){
			
			// update 
			this.changed = 0;
			
			
			// remove event
			$(window).off('beforeunload', this.unload);
			
		},
		
		unload: function(){
			
			// alert string
			return acf._e('unload');
			
		}
		 
	});
	
	
	acf.tooltip = acf.model.extend({
		
		$el: null,
		
		events: {
			'mouseenter .acf-js-tooltip':	'on',
			'mouseleave .acf-js-tooltip':	'off',
		},

		on: function( e ){
			
			//console.log('on');
			
			// vars
			var title = e.$el.attr('title');
			
			
			// hide empty titles
			if( !title ) {
				
				return;
									
			}
			
			
			// $t
			this.$el = $('<div class="acf-tooltip">' + title + '</div>');
			
			
			// append
			$('body').append( this.$el );
			
			
			// position
			var tolerance = 10;
				target_w = e.$el.outerWidth(),
				target_h = e.$el.outerHeight(),
				target_t = e.$el.offset().top,
				target_l = e.$el.offset().left,
				tooltip_w = this.$el.outerWidth(),
				tooltip_h = this.$el.outerHeight();
			
			
			// calculate top
			var top = target_t - tooltip_h,
				left = target_l + (target_w / 2) - (tooltip_w / 2);
			
			
			// too far left
			if( left < tolerance ) {
				
				this.$el.addClass('right');
				
				left = target_l + target_w;
				top = target_t + (target_h / 2) - (tooltip_h / 2);
			
			
			// too far right
			} else if( (left + tooltip_w + tolerance) > $(window).width() ) {
				
				this.$el.addClass('left');
				
				left = target_l - tooltip_w;
				top = target_t + (target_h / 2) - (tooltip_h / 2);
			
				
			// too far top
			} else if( top - $(window).scrollTop() < tolerance ) {
				
				this.$el.addClass('bottom');
				
				top = target_t + target_h;

			} else {
				
				this.$el.addClass('top');
				
			}
			
			
			// update css
			this.$el.css({ 'top': top, 'left': left });
			
			
			// avoid double title	
			e.$el.data('title', title);
			e.$el.attr('title', '');
			
		},
		
		off: function( e ){
			
			//console.log('off');
			
			// bail early if no $el
			if( !this.$el ) {
				
				return;
				
			}
			
			
			// replace title
			e.$el.attr('title', e.$el.data('title'));
			
			
			// remove tooltip
			this.$el.remove();
			
		}
		
	});
	
	
	acf.postbox = acf.model.extend({
		
		events: {
			'mouseenter .acf-postbox .handlediv':	'on',
			'mouseleave .acf-postbox .handlediv':	'o