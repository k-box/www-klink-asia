---
extends: _layouts.page
section: content
---


## Search Help

The Search is powered by [K-Link](https://k-link.technology).

You can search for keywords, phrases and use logical operators.

### Operators

- `OR`: the operator links two key-words and searches for documents which contain either one of them. When no operator is entered, the `OR` operator is assumed by the system. E.g. `Markhor report 2014` keyword combination is understood by the system as: `Markhor OR report OR 2014`
- `AND`: matches documents where both terms are used anywhere in the text. E.g. `Markhor AND report AND 2014` will display documents where all the keywords are mentioned.
- `+`: a word after this operator must exist in documents retrieved after search is performed. E.g., `+Markhor AND report AND 2014` will search for all three key-words, but with a stronger focus on `"Markhor"`. The results might also include documents containing only `"Markhor"`, but not necessarily `"report"` and `"2014"`.
- `NOT`: any document containing the keyword that you write after this operator will be excluded from the search results.

### Wildcard

- `*`: when you do not remember the whole word (common with names/surnames), you can use this operator as a wild card. The symbol can be used to look for beginning or end of the word ( `*` in the end or beginning of the keyword respectively). E.g. `Muzafar*` will return documents containing words like `Muzafarov`, `Muzafarova`, `Muzafarbek`, etc.

