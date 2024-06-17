const express = require('express');
const http = require('http');
const socketIO = require('socket.io');
const logger = require('winston');
const cors = require('cors'); // Add this line

const app = express();
const server = http.createServer(app);

const os = require('os');

function getNetworkIPs() {
	const interfaces = os.networkInterfaces();
	const ips = [];
	Object.keys(interfaces).forEach((ifname) => {
	  interfaces[ifname].forEach((iface) => {
		if ('IPv4' !== iface.family || iface.internal !== false) {
		  // Skip over internal (i.e., 127.0.0.1) and non-IPv4 addresses
		  return;
		}
		ips.push(iface.address);
	  });
	});
	return ips;
  }


app.use(cors({
	//origin: 'http://192.168.1.65', // Replace with the origin of your web page
	origin: '*',
	methods: ['GET', 'POST'],
	credentials: true,
}));


const io = socketIO(server, {
	cors: {
		//origin: "http://192.168.1.65",
		origin: '*',
		methods: ["GET", "POST"],
		credentials: true
	}
});

const PORT = process.env.PORT || 3001;

logger.add(logger.transports.File, { filename: '/var/log/my-test-logs.log' });

logger.remove(logger.transports.Console);
logger.add(logger.transports.Console, {
	colorize: true,
	timestamp: true
});


logger.info('Server Listening on ...');

io.on('connection', (socket) => {
	logger.info(`Client connected with id ${socket.id}`);

	socket.on('join', (data) => {
		const room = data.company_id.toString();
		socket.join(room, () => {
			logger.info(`Socket now in rooms ${socket.rooms}`);
		});
	});

	socket.on('newOrder', (data) => {
		logger.info(`New Order Received: ${data.alert_id} company: ${data.company_id}`);
		io.to(data.company_id.toString()).emit('newOrder', data);
	});
});

server.listen(PORT, () => {
	const ips = getNetworkIPs();
	logger.info(`Server running on port ${PORT}`);
	logger.info(`Listening on IP addresses: ${ips.join(', ')}`);
});