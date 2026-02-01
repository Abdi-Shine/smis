The error happens because the folder `rs.thehorntech.com` is NOT empty. Git clone refuses to run in a non-empty folder.

To fix this, run these exact commands in your cPanel terminal ONE BY ONE:

1. Initialize git inside the folder:
git init

2. Add your repository remote:
git remote add origin https://github.com/Abdi-Shine/smis.git

3. Fetch all the files from GitHub:
git fetch --all

4. Force your folder to match the GitHub code (this overwrites existing files):
git reset --hard origin/main

After this, your code will be pulled successfully.
