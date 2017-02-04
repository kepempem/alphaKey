# AlphaKey HTML documentation

You can solve "AlphaKey puzzles" with HTML. Follow the following steps in order to do so:

1. Include ``AlphaKey.js`` and ``AlphaKey.html.js`` in your webpage, then, in your webpage use the ``AlphaKey`` tag with the following attributes:

| Attribute | Required | Type | Description |
| --- | --- | --- | --- |
| *target* | True | String | The encrypted string you need to find a match to. |
| *fn* | True | Function | A function which takes a single string argument and returns an encrypted string. |
| *options* | False | Object | The options for the AlphaKey tester. Read [JS.md](./JS.md) for further information. |

Once the tester will find a match it will set the element's contents to the result.

Examples:
```
<AlphaKey fn="SHA1" target="15d834b328bb637eeef49b6624774bded566b659"></AlphaKey>
```
```
<AlphaKey fn="(function(guess){
    if(guess=='jes'){
      return 'Jessica';
    }
    return 'JESSICA';
  })" target="Jessica" options="{
      TESTING_LENGTH: 3
    }"></AlphaKey>
```
