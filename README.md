# Learn_Laravel
Markdown-Diff annotates word [diff][]s of [Markdown][] documents for easier review.
It reformats the output of [`wdiff`][] or `git --word-diff` in Markdown, so the changes to a Markdown document can be viewed inline.
It can also summarize commit history of Markdown documents in a Git repository as well as the changes made to them.

[Markdown]: https://en.wikipedia.org/wiki/Markdown
[diff]: https://en.wikipedia.org/wiki/Diff
[`wdiff`]: http://www.gnu.org/software/wdiff/ 


## Usage

### Download and Install the Scripts

* [markdown-format-wdiff](https://raw.github.com/netj/markdown-diff/master/markdown-format-wdiff)
* [markdown-git-changes](https://raw.github.com/netj/markdown-diff/master/markdown-git-changes)

Mark them as executable and put them in a directory that's on your `$PATH`, e.g., `~/bin/` or `/usr/local/bin/`, as shown in the following list of commands:

```bash
curl -RL \
     -O https://raw.github.com/netj/markdown-diff/master/markdown-format-wdiff \
     -O https://raw.github.com/netj/markdown-diff/master/markdown-git-changes
chmod +x markdown-format-wdiff markdown-git-changes
mkdir -p ~/bin
mv -f markdown-format-wdiff markdown-git-changes ~/bin/
export PATH=~/bin:"$PATH"
```

### Use with GNU wdiff

```bash
wdiff old.md new.md | markdown-format-wdiff >changes.md
```

### Use with Git

```bash
markdown-git-changes origin/master README.md >changes.md
```

### View the Output

```bash
# use a Markdown preview app, such as Marked
open changes.md

# or, compile it into HTML and view with your web browser
npm -g install marked
marked changes.md >changes.html
open changes.html
```



----



## An Example

<$ cd example $>

### old.md: Before Revision
```markdown
<$ cat old.md $>
```
<$ cat old.md | sed 's|^|> |' $>

### new.md: After Revision
```markdown
<$ cat new.md $>
```
<$ cat new.md | sed 's|^|> |' $>

### Unified Diff
Here's a unified diff of the two Markdown documents shown above.  It's very hard to even recognize that there're any differences between the two.
```bash
diff -u old.md new.md
```
```diff
<$ diff -u old.md new.md | tee changes.diff $>
```


### Word Diff
Here's a word diff of them generated by GNU wdiff, which is slightly better for spotting the changes, but still ugly.
```bash
wdiff old.md new.md
```
```markdown
<$ wdiff old.md new.md | tee changes.wdiff $>
```


### Markdown-Diff
Finally, here's the word diff formatted by Markdown-Diff, which displays the changes on top of the actually rendered document, making the review very productive.
```bash
wdiff old.md new.md | markdown-format-wdiff
```
<$ wdiff old.md new.md | ../markdown-format-wdiff | tee changes.md | sed 's|^|> |' $>
