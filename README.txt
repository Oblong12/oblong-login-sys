====================================
      PHP LOGIN STARTER KIT
====================================

HOW TO SET UP:

1. DATABASE (phpMyAdmin):
   - Create a database (e.g., 'login').
   - Use 'setup_db.sql' to create the 'users' table.

2. CONNECTION (db_conn.php):
   - Edit the HOST, USER, PASS, and DB name to match your environment.

3. LOGIN LOGIC (login.php):
   - Update the SQL query if you renamed your table or columns.
   - Update the header("Location: ...") to point to your main page (e.g., dashboard.php).

4. SIGNUP LOGIC (signup.php):
   - Adjust validation rules (min length, etc.) if needed.
   - Update the SQL query to match your database structure.

5. LOGOUT (logout.php):
   - Point the redirect back to your login or homepage.

6. STYLE (styles.css):
   - Change colors, fonts, and box styles.

Files are pre-labeled with /* COMMENTS */ for quick identification.
Enjoy your starter kit!
