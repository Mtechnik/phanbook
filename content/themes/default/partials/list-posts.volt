{% if posts|length %}
<div id="main-content">
    <div id="questions">
        {% for post in posts %}
            {% set vote = post.getVotes(post.getId(), 'posts'), score = vote['positive'] - vote['negative'], postReplies = post.getNumberReply() %}
            <div id="question-summary-{{post.getId()}}" class="question-summary narrow">
                <div class="votes {% if post.getAcceptedAnswer() == "Y"%}answered-accepted {% elseif postReplies > 1 %} answered {% else %} unanswered {% endif %}">
                    <div class="vote-block">
                        <span class="mini-counts" title="{{ score }}">{{ score }}</span>
                        <span class="icon-vote"></span>
                    </div>
                    <div class="answer-block">
                        <span class="mini-counts" title="{{postReplies}}">{{postReplies}}</span>
                        <span class="icon-answer"></span>
                    </div>
                </div>
                <div class="question-title">
                    {% set postLink = post.getType() ~ '/' ~ post.getId() ~ '/' ~ post.getSlug() %}
                    {{ link_to(postLink, 'class' : 'question-hyperlink', post.getTitle())}}
                    <div class="tags">
                        {% for tag in post.tag %}
                            {{link_to('tags/' ~ tag.getId() ~ '/' ~ tag.getSlug(),'class':'post-tag', tag.getName())}}
                            &nbsp;
                        {% endfor %}
                    </div>
                    <div class="question-meta">
                        {#<a class="m-hide answer" href="/{{ postLink }}">
                            <span>{{ postReplies }} </span>{{ t('Answers')}},
                        </a>
                        #}
                        {% if post.getHumanModifiedAt() %}
                                <a class="started-link" href="/{{ postLink }}">
                                    {{ t('Modified ')}}
                                    <span class="relativetime" title="{{date('m/d/Y H:i:s', post.getModifiedAt())}}">
                                    {{ post.getHumanModifiedAt() }}
                                </span></a>
                        {% else %}
                                <a class="started-link" href="/{{ postLink }}">
                                    {{ t('Created')}}
                                    <span class="relativetime" title="{{date('m/d/Y H:i:s', post.getCreatedAt())}}">
                                    {{ post.getHumanCreatedAt() }}
                                </span></a>
                        {% endif %}
                        <a class="author" href="/@{{post.user.getUsername()}}">
                            {{ post.user.getFullName() }}
                            <span title="reputation" class="reputation-score">
                                {{ post.user.getHumanKarma() }}
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        {% endfor %}
    </div>
    {{ partial('partials/pagination')}}
</div>
{% else %}
<div class="container">
    <p class="alert alert-info">There are no posts here</p>
</div>
{% endif %}
