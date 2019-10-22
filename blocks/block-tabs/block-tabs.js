
var el = wp.element.createElement,
    registerBlockType = wp.blocks.registerBlockType,
    ServerSideRender = wp.components.ServerSideRender,
    TextControl = wp.components.TextControl,
    TextareaControl = wp.components.TextareaControl,
    InspectorControls = wp.editor.InspectorControls;

/** Set the icon for your block */
var mb_icon = el ("img", {
  src: "/wp-content/plugins/mb.gutemberg-block/images/mb_block.svg",
  width: "50px",
  height: "50px"
});

/** Register the block */
registerBlockType( 'cooltech/block-tabs', {
  title: 'Tabs',
  icon: mb_icon,
  category: 'widgets',

  attributes: {
    'mb_url': {
      type: 'string',
      default: ""
    },
  },

  edit: (props) => {

    if(props.isSelected){
      // do something...
      console.debug(props.attributes);
    };

    return [
      /**
       * Server side render
       */
      el("div", {
            className: "mb-editor-container",
            style: {textAlign: "center"}
          },
          el( ServerSideRender, {
            block: 'cooltech/block-tabs',
            attributes: props.attributes
          } )
      ),

      /**
       * Inspector
       */
      el( InspectorControls,
          {}, [
            el( "hr", {
              style: {marginTop:20}
            }),

            el( TextControl, {
              label: 'Pages',
              value: props.attributes.mb_url,
              onChange: ( value ) => {
                props.setAttributes( { mb_url: value } );
              }
            } ),
          ]
      )
    ]
  },

  save: () => {
    /** this is resolved server side */
    return null
  }
} );
