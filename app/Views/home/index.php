<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        h1, h2, h3 {
            color: #2c3e50;
        }
        h1 {
            text-align: center;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        h2 {
            margin-top: 30px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }
        .section {
            margin-bottom: 30px;
        }
        .feature-list {
            list-style-type: none;
            padding: 0;
        }
        .feature-list li {
            padding: 10px;
            margin: 5px 0;
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            border-radius: 0 4px 4px 0;
        }
        .code-block {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            font-family: monospace;
            margin: 10px 0;
            border: 1px solid #dee2e6;
        }
        .note {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 15px;
            margin: 15px 0;
            border-radius: 0 4px 4px 0;
        }
        .project-structure {
            background: #e9ecef;
            padding: 15px;
            border-radius: 4px;
            font-family: monospace;
            margin: 10px 0;
        }
        .nav-links {
            text-align: center;
            margin: 20px 0;
        }
        .nav-links a {
            color: #007bff;
            text-decoration: none;
            margin: 0 10px;
        }
        .nav-links a:hover {
            text-decoration: underline;
        }
        .support-section {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin: 30px 0;
        }
        .support-section a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background: #FFDD00;
            color: #000;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: all 0.3s ease;
        }
        .support-section a:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .example-table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }
        .example-table th, .example-table td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: left;
        }
        .example-table th {
            background: #f8f9fa;
            font-weight: bold;
        }
        .example-table tr:nth-child(even) {
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><?php echo $title; ?></h1>
        
        <div class="nav-links">
            <a href="#features">Features</a>
            <a href="#structure">Project Structure</a>
            <a href="#usage">Usage</a>
            <a href="#routing">Routing</a>
            <a href="#contributing">Contributing</a>
            <a href="#support">Support</a>
        </div>

        <div class="section" id="features">
            <h2>Features</h2>
            <ul class="feature-list">
                <li>Simple and lightweight MVC architecture</li>
                <li>Easy to understand and extend</li>
                <li>Built-in routing system</li>
                <li>View rendering with data passing</li>
                <li>Database abstraction layer</li>
                <li>Docker support for easy setup</li>
                <li>Environment configuration via .env</li>
            </ul>
        </div>

        <div class="section" id="structure">
            <h2>Project Structure</h2>
            <div class="project-structure">
                app/<br>
                ├── Config/         # Configuration files<br>
                ├── Controller/     # Application controllers<br>
                ├── Core/          # Framework core classes<br>
                ├── Model/         # Data models<br>
                ├── Repository/    # Data access layer<br>
                └── Views/         # View templates<br>
                bootstrap/         # Application bootstrap<br>
                test/             # Unit tests<br>
                .env              # Environment configuration<br>
                composer.json     # Dependencies
            </div>
        </div>

        <div class="section" id="usage">
            <h2>Usage</h2>
            
            <h3>Creating a Controller</h3>
            <div class="code-block">
                namespace App\Controller;<br><br>
                class MyController extends Controller {<br>
                &nbsp;&nbsp;public function index() {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;$data = ['message' => 'Hello World'];<br>
                &nbsp;&nbsp;&nbsp;&nbsp;$this->render('my/view', $data);<br>
                &nbsp;&nbsp;}<br>
                }
            </div>

            <h3>Creating a View</h3>
            <div class="code-block">
                &lt;div class="container"&gt;<br>
                &nbsp;&nbsp;&lt;h1&gt;&lt;?php echo $message; ?&gt;&lt;/h1&gt;<br>
                &lt;/div&gt;
            </div>
        </div>

        <div class="section" id="routing">
            <h2>Routing</h2>
            <p>The framework uses a simple URL routing system. Here's how it works:</p>

            <h3>URL Structure</h3>
            <p>The URL structure follows this pattern:</p>
            <div class="code-block">
                http://your-domain.com/controller-name/method-name
            </div>

            <h3>Examples</h3>
            <table class="example-table">
                <tr>
                    <th>URL</th>
                    <th>Controller</th>
                    <th>Method</th>
                    <th>Description</th>
                </tr>
                <tr>
                    <td>/my/index</td>
                    <td>MyController</td>
                    <td>index()</td>
                    <td>Default method</td>
                </tr>
                <tr>
                    <td>/my/show/123</td>
                    <td>MyController</td>
                    <td>show(123)</td>
                    <td>With parameter</td>
                </tr>
                <tr>
                    <td>/user/profile</td>
                    <td>UserController</td>
                    <td>profile()</td>
                    <td>Custom method</td>
                </tr>
                <tr>
                    <td>/</td>
                    <td>HomeController</td>
                    <td>index()</td>
                    <td>Default route</td>
                </tr>
            </table>

            <div class="note">
                <strong>Note:</strong> Make sure to set the correct APP_PATH in your .env file:
                <ul>
                    <li>For local development: APP_PATH=localhost:8000</li>
                    <li>For Docker: APP_PATH=localhost:3333</li>
                </ul>
            </div>
        </div>

        <div class="section" id="contributing">
            <h2>Contributing</h2>
            <p>Contributions are welcome! Please feel free to submit a Pull Request.</p>
            <div class="note">
                <strong>Before contributing:</strong>
                <ul>
                    <li>Fork the repository</li>
                    <li>Create your feature branch</li>
                    <li>Commit your changes</li>
                    <li>Push to the branch</li>
                    <li>Create a Pull Request</li>
                </ul>
            </div>
        </div>

        <div class="section" id="support">
            <h2>Support the Project</h2>
            <div class="support-section">
                <p>If you find this project helpful and would like to support its development, consider buying me a coffee!</p>
                <a href="https://buymeacoffee.com/phuongdanh" target="_blank">Buy Me a Coffee ☕</a>
            </div>
        </div>
    </div>
</body>
</html> 