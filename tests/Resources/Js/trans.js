Translator.trans('arg-key');
Translator.trans('arg-key-params', {});
Translator.trans('arg-key-params-domain', {}, 'domain_name');
Translator.trans('arg-key-params-filled', { foo: "bar", "foo-bar": "fill me" });
Translator.trans('multiline-arg-key-params-filled-domain', {
    foo: "bar",
    "foo-bar": "fill me"
}, 'crazy-domain');

Translator.trans(
  	'multiline-tab-arg-key-params-filled-domain', {
  		foo: "bar",
		"foo-bar": "fill me"
	},
	'real-crazy-domain'
);


