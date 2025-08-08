# Building a PHP Web App with Nginx on an M4 Macbook Pro

This guide will walk you through setting up a local development environment on your M4 Macbook Pro to run a simple PHP web application using the Nginx web server. We'll cover installing the necessary software, configuring it, and creating your first PHP page based on the official PHP tutorial.

---

## 1. Prerequisites: Homebrew

Before we install Nginx and PHP, we need a package manager. **Homebrew** is the most popular package manager for macOS, and it simplifies the process of installing software.

To install Homebrew, open the **Terminal** app (you can find it in `/Applications/Utilities/`) and paste the following command, then press **Enter**:

```bash
/bin/bash -c "$(curl -fsSL [https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh](https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh))"
```

This script will download and install Homebrew on your system. It might ask for your password during the installation.

---

## 2. Installing Nginx

With Homebrew installed, you can now easily install Nginx.

1.  **Update Homebrew:** It's always a good idea to make sure Homebrew is up-to-date before installing new packages.

    ```bash
    brew update
    ```

2.  **Install Nginx:** Now, install Nginx with the following command:

    ```bash
    brew install nginx
    ```

3.  **Start Nginx:** To start the Nginx service, run:

    ```bash
    brew services start nginx
    ```

4.  **Verify Installation:** You can verify that Nginx is running by visiting `http://localhost:8080` in your web browser. You should see a "Welcome to nginx!" page.

    *Note: By default, Homebrew's Nginx is configured to run on port 8080 to avoid conflicts with other services that might use the default web port 80.*

---

## 3. Installing PHP

Next, we'll install PHP.

1.  **Install PHP:** Use Homebrew to install the latest version of PHP.

    ```bash
    brew install php
    ```

2.  **Start PHP-FPM:** PHP-FPM (FastCGI Process Manager) is what Nginx uses to execute PHP code. Start the PHP-FPM service:

    ```bash
    brew services start php
    ```

---

## 4. Configuring Nginx to Use PHP

Now we need to tell Nginx how to handle PHP files. This involves editing the Nginx configuration file.

1.  **Open the Nginx Configuration File:** The configuration file for Nginx on an Apple Silicon Mac is located at `/opt/homebrew/etc/nginx/nginx.conf`. You can open it with a text editor like `nano`:

    ```bash
    nano /opt/homebrew/etc/nginx/nginx.conf
    ```

2.  **Modify the `server` Block:** Inside the `nginx.conf` file, locate the `server` block. We need to make a few changes:
    * Update the `root` directive to your specific Nginx `html` directory.
    * Add `index.php` to the `index` directive *before* `index.html`.
    * Uncomment and modify the `location ~ \.php$` block to tell Nginx to pass PHP files to PHP-FPM, ensuring the `root` path matches and using the correct `fastcgi_param`.

    Your `server` block should look like this (replace `1.29.0` with your actual Nginx version if it differs):

    ```nginx
    server {
        listen       8080;
        server_name  localhost;

        #charset koi8-r;

        #access_log  logs/host.access.log  main;

        location / {
            root   /opt/homebrew/Cellar/nginx/1.29.0/html;
            index  index.php index.html index.htm;
        }

        #error_page  404              /404.html;

        # redirect server error pages to the static page /50x.html
        #
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }

        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
        location ~ \.php$ {
            root           /opt/homebrew/Cellar/nginx/1.29.0/html;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            # This is the corrected line to prevent "File Not Found" errors.
            fastcgi_param  SCRIPT_FILENAME $request_filename;
            include        fastcgi_params;
        }

        # deny access to .htaccess files, if Apache's document root
        # concurs with nginx's one
        #
        #location ~ /\.ht {
        #    deny  all;
        #}
    }
    ```

3.  **Save and Exit:** If you're using `nano`, press `Ctrl+X`, then `Y` to confirm the changes, and `Enter` to save the file.

4.  **Restart Nginx:** For the changes to take effect, you need to restart the Nginx service.

    ```bash
    brew services restart nginx
    ```

---

## 5. Creating Your First PHP Web App

Now that everything is set up, let's create a simple PHP application.

1.  **Navigate to the Web Root:** The web root directory is where Nginx looks for files to serve. Navigate to this directory (replace `1.29.0` with your Nginx version):

    ```bash
    cd /opt/homebrew/Cellar/nginx/1.29.0/html
    ```

2.  **Remove the Default `index.html`:** The default Nginx installation includes an `index.html` file. This can prevent your `index.php` from being displayed. If it exists, remove it:

    ```bash
    rm index.html
    ```

3.  **Create an `index.php` File:** Create a new file named `index.php`. You can use `nano` for this:

    ```bash
    nano index.php
    ```

4.  **Add PHP Code:** Paste the following PHP code into the file. This code is from the PHP tutorial and will display information about your PHP installation.

    ```php
    <!DOCTYPE html>
    <html>
        <head>
            <title>PHP Test</title>
        </head>
        <body>
            <?php echo '<p>Hello World</p>'; ?>
            <?php phpinfo(); ?>
        </body>
    </html>
    ```

5.  **Save and Exit:** Save the file and exit the editor.

6.  **Test Your App:** Open your web browser and navigate to `http://localhost:8080`. You should now see "Hello World" followed by a detailed table with your PHP configuration information.

Congratulations! You have successfully set up a PHP web application with Nginx on your M4 Macbook Pro. You can now start building more complex PHP applications in your local development environment.
