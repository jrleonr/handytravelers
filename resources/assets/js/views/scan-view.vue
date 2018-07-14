<template>
	<div>
		  <ais-index 
		  	app-id="KQV8NDRJ2H" 
		  	api-key="9a84f12fd03268c48a48aaf180a4e9fb" 
		  	index-name="homes"
		  	:query-parameters="{
             query: query,
           }"
		  	>
		  	<div class="columns">
		  		<div class="sidebar column is-4 pl-2">
		  			<ul>
		  				<li class="filterable-item">
		  					<h4 class="filterable-heading has-icon mt-0"> 
		  						<span class="icon">
		  							<img src="">
		  						</span>
		  						Search
		  					</h4>
		  					<ais-search-box :autofocus="true" placeholder="Barcelona"></ais-search-box>
		  				</li>

		  				
		  				

		  				
		  				<li class="filterable-item">
		  					
		  					<ais-refinement-list attribute-name="type">
		  						<h4 slot="header">Type</h4>
		  					</ais-refinement-list>
		  				</li>


		  				<li class="filterable-item">
		  					
		  					<ais-refinement-list attribute-name="users.languages" :sort-by="['count:desc']">
		  						<h4 slot="header">Languages</h4>
		  					</ais-refinement-list>
		  				</li>

		  			</ul>
		  		</div>
		  		<div class="primary column is-8">
		  			<ais-no-results></ais-no-results>
		  			<ais-stats></ais-stats>
		  			    
		  			    	<ul class="user-list">
		  			    		<ais-results class="user-list columns is-multiline is-mobile">
		  			    			<template slot-scope="{ result }">
		  			    				<li class="user-list-item column is-4 ">
		  			    					<div class="user-list-details card">
		  			    						<div class="card-image">
													<figure class="image ">
														<a class="title is-4" :href=" '/traveler/' + result.users[0].username"	>
															<img :src=" result.users[0].image ">
														</a>
												    	
												    </figure>
												</div>
												<div class="card-content">
												    <div class="media">
												      
												      <div class="media-content">
												        <a class="title is-4" :href=" '/traveler/' + result.users[0].username" v-text="result.users[0].first_name"></a>
												      </div>

												    
												    </div>
												    <div class="content">
														<div class="tags">
														  <span class="tag is-primary" v-show="result.type" v-text="result.type"></span>
														</div>
		  			    						
													     
													  </div>
												  </div>
		  			    						
		  			    					</div>
		  			    				</li>
  
      
      </template>
    </ais-results>
		  			    		
		  			    	</ul>

      
    <ais-pagination :class-names="{
	  'ais-pagination': 'pagination is-centered',
	  'ais-pagination__item': 'pagination-link',
	  'ais-pagination__item--active': 'is-current',
	  'ais-pagination__link': '',
	}" v-on:page-change="onPageChange"></ais-pagination>
		  		</div>
		  	</div>
		  </ais-index>
	</div>
</template>
<script>
  export default {
  	props: ['query'],
    methods: {
      onPageChange(page) {
        window.scrollTo(0,0);
      }
    }
  }
</script>
