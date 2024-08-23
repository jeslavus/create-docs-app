# Use an official node image as a parent image
FROM node:16-alpine

# Set working directory
WORKDIR /app

# Install dependencies
COPY package*.json ./
RUN npm install

# Copy the current directory contents into the container at /app
COPY . .

# Build the Vue.js application
RUN npm run build

# Serve the application
EXPOSE 8080
CMD ["npm", "run", "serve"]