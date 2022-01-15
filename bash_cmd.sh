for f in ./*/*.JPG; do
convert "$f" -quality 1 "$f"
done;

