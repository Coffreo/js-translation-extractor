Translator.transChoice('arg-key', 1);
Translator.transChoice('arg-key-params', 1, {});
Translator.transChoice('arg-key-params-domain', 1, {}, 'domain_name');
Translator.transChoice('arg-key-params-filled', variable, { foo: "bar", "foo-bar": "fill me" });
Translator.transChoice('multiline-arg-key-params-filled-domain', variable, {
    foo: "bar",
    "foo-bar": "fill me"
}, 'crazy-domain');

Translator.transChoice(
  	'multiline-tab-arg-key-params-filled-domain',
	1, {
		foo: "bar",
		"foo-bar": "fill me"
	},
	'real-crazy-domain'
);


