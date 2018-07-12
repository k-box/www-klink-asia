---
extends: _layouts.pilot.page
section: content
title: How K-Link works
description: How K-Link Works, from the Search Engine to the K-Link Core and the K-Link network
---


K-Link is a service oriented to document management within an organization, and at the same time enables creation of a community of practice between organizations involved in a specific topic.

It's like having your private organization search engine that targets valuable materials from your community.

With this goal in mind, the K-Link Architecture has a distributed component called [*K-Link Network*](#klink-network), including a set of [services that can run inside your institutions](#components).

<div class="text-center">	
	<img src="/assets/images/pilot/klink-how-works-intro.png" class=" my-8" />
</div>

<div class="my-8">

<p>The overall K-Link Architecture follows the approach of Service Oriented Architecture, where different components communicate together to offer a comprehensive service.</p>

<p>The Service Oriented Architecture allows for increased scalability and flexibility in the setup and deployment of services. In addition, each service runs in a sandbox to minimize the risk of a compromised service damaging the system.</p>

<p>Some services are deployed inside the institution/organization to preserve data ownership and establish a degree of offline access. Varying levels of user-access can be defined. Other services offered to the organization, such as the public network, are deployed externally.</p>

</div>

<div class="my-8" id="components">

	<h3 id="components">K-Link Components</h3>

	<p>The K-Link Service oriented architecture is composed by four main components: a document management system, K-Core, a search engine and a geo-location extraction. These components enable the K-Link to perform searches, organize documents and respond to the K-Link goals previously identified.</p>

	<div class="flex">

		<div class="w-1/2">

			<h3 class="mb-4 p-4">Document Management System (K-DMS)</h3>
			
			<ul class="cleanul">
			 <li>Guarantees secure online access to your information </li>
            <li>Allows organizing your information using documents collections </li>
            <li>Minimizes forest of files (sensitive to identical content)</li>
            <li>Uses content-based search and filters to accelerate information retrieval</li>
            <li>Allows publishing information from the system (to your website and Public Network)</li>
			</ul>

		</div>

		<div class="w-1/2 text-center">

			<img src="/assets/images/pilot/klink-components.png"  />
			
			
		</div>


	</div>

	<div class="flex my-4">

		<div class="w-1/3 p-4">

			<h3 class="mb-4 p-4">K-Core</h3>
			
			<ul class="cleanul">
			<li>The base service for interacting with the search engine</li>
			<li>Exposes an API for performing full-text indexing and retrieval of a document</li>
			</ul>
			
			
		</div>

		<div class="w-1/3 p-4">

			<h3 class="mb-4 p-4">Search Engine</h3>
			
			<ul class="cleanul">
			<li>Is the heart of the retrieval capabilities of the K-Link</li>
			<li>Uses Apache Solr</li>
			<li>Identifies the language of a document based on probability and an index of known words</li>
			</ul>
			
			
		</div>

		<div class="w-1/3 p-4">

			<h3 class="mb-4 p-4">Geolocation Entity Recognition</h3>
			
			<ul class="cleanul">
<li>Extracts words that refer to known Geographical Places to find documents that cite a particular location (e.g. forest, city, river,...)</li>
<li>Uses the Name Entity Recognition Technique implemented by <a href="https://github.com/Berico-Technologies/CLAVIN">Cartographic Location And Vicinity INdexer (Clavin)</a></li>
 </ul>

		</div>


	</div>
	
	
</div>


<div class="my-8" id="klink-network">

	<h2>K-Link Network</h2>

	


<div class="flex justify-between">

	<div class="w-1/2">

		<p>Is a distributed network where documents remain in the possession of their owners. Only metadata are stored on the network infrastructure, promoting faster searches.</p>

		<p>Documents are distributed on each network node, while search is performed on the Network Entry Point.</p>

		<p>The Network Entry Point servers are the access points to the network infrastructure, which offer search/retrieval and document indexing capabilities.</p>

		<p>The K-Link Network is constructed on top of the same base services that are deployed locally in the institution: the <strong>K-Core</strong>, the Search Engine and the Geographic Entity Recognition service.</p>
		
		<p>The interaction with the network is based on a secure Application Programming Interface (API) that enables the development of customized services and the usage of the organization’s existing infrastructure. In fact, this website uses the same API to offer the search.</p>

	</div>

	<div class="w-1/2 text-center p-4">

		<img src="/assets/images/pilot/klink-network.png"  />

	</div>
</div>

<div class="my-8">

	<h2 id="added-value">Integration Methods</h2>

	<p>K-Link can be integrated inside your institution infrastructure in two different ways: (1) K-Box or (2) Custom integration. Integration with K-Box is defined as plug and play. In both cases, a requirement analysis and assessment study will take place to suggest the best way of empowering your institution with the services offered by K-Link.</p>

	<div class="flex">

		<div class="w-1/3 p-4">

			<h3 class="mb-4">K-Box with K-Link DMS</h3>
			
			<p>If your institution does not have a server for storing/managing documents or you want the K-Link to be separated from you existing process we offer the K-Box solution.</p>

			<p>The K-Box offers all the K-Link Services (K-DMS, Public Network connection) in a single computer that you can attach to your local network. In this way the DMS will be accessible from inside your organization and can be accessed also from outside.</p>
			
			
		</div>

		<div class="w-1/3 p-4 text-center">

			<img src="/assets/images/pilot/kbox-deployment.png"  />
			
			
		</div>

		<div class="w-1/3 p-4">

			<h3 class="mb-4">Integration with existing infrastructure</h3>
			
			<p>If your organization already has a way to store and manage documents, then please Contact Us to make a requirement analysis and assesment study.</p>
			
		</div>


	</div>
	
	
</div>
