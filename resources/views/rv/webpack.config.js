var path = require("path");
var webpack =  require("webpack");

var auth_conf = {
	entry: __dirname+'/src/login.jsx',
        output: { path: __dirname+'/../../../public/js/', filename: 'login.js'},
        watch: false,
        module: {
                loaders : [{
                        test: /.jsx?/,
                        loader: 'babel-loader',
                        exclude: '/node_modules',
                        query: {
                                presets: ['es2015', 'react']
                        }
                }]
        }
	}

var admin_conf = {
	entry: __dirname+'/src/admin.jsx',
        output: { path: __dirname+'/../../../public/js/', filename: 'admin.js'},
        watch: true,
        module: {
                loaders : [{
                        test: /.jsx?/,
                        loader: 'babel-loader',
                        exclude: '/node_modules',
                        query: {
                                presets: ['es2015', 'react']
                        }
        	}]
	}
}

var client_conf = {
	entry: __dirname+'/src/client.jsx',
        output: { path: __dirname+'/../../../public/js/', filename: 'client.js'},
        watch: true,
        module: {
                loaders : [{
                        test: /.jsx?/,
                        loader: 'babel-loader',
                        exclude: '/node_modules',
                        query: {
                                presets: ['es2015', 'react']
                        }
        	}]
	}
}
module.exports = [admin_conf, client_conf]
