<?php
/*
 * 青和后台管理系统
 * 作者：青和
 * QQ：1722791510
 * 邮箱：admin@tsinho.cn
 */
 
include 'head.php';
?>
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --dark-color: #2c3e50;
            --light-color: #ecf0f1;
            --gray-color: #95a5a6;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f9f9f9;
            padding: 0;
            margin: 0;
        }
        
        header {
            background-color: var(--dark-color);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
            text-align: center;
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .subtitle {
            font-size: 1.2rem;
            color: var(--light-color);
            opacity: 0.9;
        }
        
        .guide-section {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        h2 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--light-color);
        }
        
        
        
        .code-block {
            background-color: #f5f5f5;
            border-left: 4px solid var(--primary-color);
            padding: 1rem;
            margin: 1rem 0;
            font-family: 'Courier New', Courier, monospace;
            overflow-x: auto;
        }
        
        .example {
            border: 1px solid #ddd;
            padding: 1rem;
            margin: 1rem 0;
            border-radius: 4px;
            background-color: white;
        }
        
        .example-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
            color: var(--gray-color);
        }
        
        .element-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin: 1.5rem 0;
        }
        
        .element-card {
            border: 1px solid #eee;
            border-radius: 6px;
            padding: 1rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .element-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .element-card h4 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .element-card h4 i {
            margin-right: 0.5rem;
        }
        
        .note {
            background-color: #fff8e1;
            border-left: 4px solid var(--warning-color);
            padding: 1rem;
            margin: 1rem 0;
        }
        
        .note-title {
            font-weight: bold;
            color: var(--warning-color);
            margin-bottom: 0.5rem;
        }
        
        footer {
            text-align: center;
            padding: 2rem 0;
            color: var(--gray-color);
            font-size: 0.9rem;
        }
        
        .icon-list {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .icon-item {
            display: flex;
            align-items: center;
            padding: 0.5rem;
            background: #f5f5f5;
            border-radius: 4px;
        }
        
        .icon-item i {
            margin-right: 0.5rem;
            width: 20px;
            text-align: center;
            color: var(--primary-color);
        }
    </style>
    <div class="page-header">
                <h1>博客文章美化指南</h1>
                <div>
                    <a style="text-decoration:none" href="posts.php" class="btn btn-outline-secondary"><i class="fas fa-arrow-left"></i> 返回列表</a>
                </div>
            </div>
    
    <div class="container">
        <section class="guide-section">
            <h2><i class="fas fa-info-circle"></i> 基本介绍</h2>
            <p>本指南将帮助您使用HTML标签和预设的CSS类来格式化您的博客文章。所有内容应包裹在<code>&lt;article class="blog-article"&gt;</code>标签中。</p>
            
            <div class="code-block">
&lt;article class="blog-article"&gt;
    &lt;!-- 您的文章内容放在这里 --&gt;
&lt;/article&gt;
            </div>
            
            <div class="note">
                <div class="note-title"><i class="fas fa-exclamation-triangle"></i> 重要提示</div>
                <p>请确保所有内容都包含在<code>&lt;article class="blog-article"&gt;</code>标签内，否则样式可能无法正确应用。</p>
            </div>
        </section>
        
        <section class="guide-section">
            <h2><i class="fas fa-heading"></i> 标题样式</h2>
            <p>使用以下类来定义不同级别的标题：</p>
            
            <div class="element-grid">
                <div class="element-card">
                    <h4><i class="fas fa-h1"></i> 主标题</h4>
                    <div class="code-block">
&lt;h1 class="article-title"&gt;文章主标题&lt;/h1&gt;
                    </div>
                    <div class="example">
                        <div class="example-title">效果预览</div>
                        <h1 class="article-title" style="margin:0">文章主标题</h1>
                    </div>
                </div>
                
                <div class="element-card">
                    <h4><i class="fas fa-h2"></i> 副标题</h4>
                    <div class="code-block">
&lt;h2 class="article-subtitle"&gt;文章副标题&lt;/h2&gt;
                    </div>
                    <div class="example">
                        <div class="example-title">效果预览</div>
                        <h2 class="article-subtitle" style="margin:0">文章副标题</h2>
                    </div>
                </div>
                
                <div class="element-card">
                    <h4><i class="fas fa-h3"></i> 章节标题</h4>
                    <div class="code-block">
&lt;h3 class="article-section"&gt;章节标题&lt;/h3&gt;
                    </div>
                    <div class="example">
                        <div class="example-title">效果预览</div>
                        <h3 class="article-section" style="margin:0">章节标题</h3>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="guide-section">
            <h2><i class="fas fa-paragraph"></i> 文本样式</h2>
            <p>为段落文本提供多种样式选择：</p>
            
            <div class="element-grid">
                <div class="element-card">
                    <h4><i class="fas fa-align-left"></i> 普通段落</h4>
                    <div class="code-block">
&lt;p class="article-text"&gt;这是普通段落文本...&lt;/p&gt;
                    </div>
                    <div class="example">
                        <div class="example-title">效果预览</div>
                        <p class="article-text" style="margin:0">这是普通段落文本，用于文章的主要内容。</p>
                    </div>
                </div>
                
                <div class="element-card">
                    <h4><i class="fas fa-highlighter"></i> 高亮段落</h4>
                    <div class="code-block">
&lt;p class="article-highlight"&gt;这是高亮段落文本...&lt;/p&gt;
                    </div>
                    <div class="example">
                        <div class="example-title">效果预览</div>
                        <p class="article-highlight" style="margin:0">这是高亮段落文本，用于强调重要内容。</p>
                    </div>
                </div>
                
                <div class="element-card">
                    <h4><i class="fas fa-quote-right"></i> 引用文本</h4>
                    <div class="code-block">
&lt;p class="article-quote"&gt;这是引用文本...&lt;/p&gt;
                    </div>
                    <div class="example">
                        <div class="example-title">效果预览</div>
                        <p class="article-quote" style="margin:0">这是引用文本，用于突出显示引用的内容。</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="guide-section">
            <h2><i class="fas fa-list-ul"></i> 列表样式</h2>
            <p>有序和无序列表的样式：</p>
            
            <div class="element-grid">
                <div class="element-card">
                    <h4><i class="fas fa-list-ol"></i> 有序列表</h4>
                    <div class="code-block">
&lt;ol class="article-list"&gt;
    &lt;li&gt;第一项&lt;/li&gt;
    &lt;li&gt;第二项&lt;/li&gt;
    &lt;li&gt;第三项&lt;/li&gt;
&lt;/ol&gt;
                    </div>
                    <div class="example">
                        <div class="example-title">效果预览</div>
                        <ol class="article-list" style="margin:0; padding-left: 1.5rem;">
                            <li>第一项</li>
                            <li>第二项</li>
                            <li>第三项</li>
                        </ol>
                    </div>
                </div>
                
                <div class="element-card">
                    <h4><i class="fas fa-list-ul"></i> 无序列表</h4>
                    <div class="code-block">
&lt;ul class="article-list"&gt;
    &lt;li&gt;项目一&lt;/li&gt;
    &lt;li&gt;项目二&lt;/li&gt;
    &lt;li&gt;项目三&lt;/li&gt;
&lt;/ul&gt;
                    </div>
                    <div class="example">
                        <div class="example-title">效果预览</div>
                        <ul class="article-list" style="margin:0; padding-left: 1.5rem;">
                            <li>项目一</li>
                            <li>项目二</li>
                            <li>项目三</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="guide-section">
            <h2><i class="fas fa-link"></i> 链接与多媒体</h2>
            <p>链接、图片和多媒体元素的样式：</p>
            
            <div class="element-grid">
                <div class="element-card">
                    <h4><i class="fas fa-link"></i> 超链接</h4>
                    <div class="code-block">
&lt;a href="https://example.com" class="article-link"&gt;示例链接&lt;/a&gt;
                    </div>
                    <div class="example">
                        <div class="example-title">效果预览</div>
                        <a href="#" class="article-link" style="color: #3498db; text-decoration: none; border-bottom: 1px dashed #3498db;">示例链接</a>
                    </div>
                </div>
                
                <div class="element-card">
                    <h4><i class="fas fa-image"></i> 图片</h4>
                    <div class="code-block">
&lt;img src="image.jpg" alt="描述" class="article-image"&gt;
                    </div>
                    <div class="code-block">
&lt;figure class="article-figure"&gt;
    &lt;img src="image.jpg" alt="描述"&gt;
    &lt;figcaption class="article-caption"&gt;图片说明文字&lt;/figcaption&gt;
&lt;/figure&gt;
                    </div>
                </div>
                
                <div class="element-card">
                    <h4><i class="fas fa-video"></i> 视频</h4>
                    <div class="code-block">
&lt;div class="article-video"&gt;
    &lt;video controls&gt;
        &lt;source src="video.mp4" type="video/mp4"&gt;
    &lt;/video&gt;
&lt;/div&gt;
                    </div>
                </div>
                
                <div class="element-card">
                    <h4><i class="fas fa-music"></i> 音频</h4>
                    <div class="code-block">
&lt;div class="article-audio"&gt;
    &lt;audio controls&gt;
        &lt;source src="audio.mp3" type="audio/mpeg"&gt;
    &lt;/audio&gt;
&lt;/div&gt;
                    </div>
                </div>
            </div>
        </section>
        
        <section class="guide-section">
            <h2><i class="fas fa-table"></i> 表格样式</h2>
            <p>创建美观的表格：</p>
            
            <div class="code-block">
&lt;table class="article-table"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th&gt;标题1&lt;/th&gt;
            &lt;th&gt;标题2&lt;/th&gt;
            &lt;th&gt;标题3&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
        &lt;tr&gt;
            &lt;td&gt;内容1&lt;/td&gt;
            &lt;td&gt;内容2&lt;/td&gt;
            &lt;td&gt;内容3&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
            &lt;td&gt;内容4&lt;/td&gt;
            &lt;td&gt;内容5&lt;/td&gt;
            &lt;td&gt;内容6&lt;/td&gt;
        &lt;/tr&gt;
    &lt;/tbody&gt;
&lt;/table&gt;
            </div>
            
            <div class="example">
                <div class="example-title">效果预览</div>
                <table class="article-table" style="width: 100%; border-collapse: collapse; margin: 1rem 0;">
                    <thead>
                        <tr style="background-color: #f2f2f2;">
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">标题1</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">标题2</th>
                            <th style="padding: 12px; text-align: left; border-bottom: 2px solid #ddd;">标题3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="border-bottom: 1px solid #ddd;">
                            <td style="padding: 12px;">内容1</td>
                            <td style="padding: 12px;">内容2</td>
                            <td style="padding: 12px;">内容3</td>
                        </tr>
                        <tr>
                            <td style="padding: 12px;">内容4</td>
                            <td style="padding: 12px;">内容5</td>
                            <td style="padding: 12px;">内容6</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
        
        <section class="guide-section">
            <h2><i class="fas fa-code"></i> 代码块</h2>
            <p>展示代码的样式：</p>
            
            <div class="code-block">
&lt;pre class="article-code"&gt;&lt;code&gt;
function helloWorld() {
    console.log("Hello, World!");
}
&lt;/code&gt;&lt;/pre&gt;
            </div>
            
            <div class="example">
                <div class="example-title">效果预览</div>
                <pre class="article-code" style="background-color: #f5f5f5; padding: 1rem; border-radius: 4px; overflow-x: auto;"><code style="font-family: 'Courier New', Courier, monospace;">
function helloWorld() {
    console.log("Hello, World!");
}
                </code></pre>
            </div>
        </section>
        
        <section class="guide-section">
            <h2><i class="fas fa-icons"></i> Font Awesome 图标</h2>
            <p>您可以在文章中使用以下Font Awesome图标类：</p>
            
            <div class="icon-list">
                <div class="icon-item">
                    <i class="fas fa-info-circle"></i>
                    <span>fas fa-info-circle</span>
                </div>
                <div class="icon-item">
                    <i class="fas fa-check"></i>
                    <span>fas fa-check</span>
                </div>
                <div class="icon-item">
                    <i class="fas fa-exclamation-triangle"></i>
                    <span>fas fa-exclamation-triangle</span>
                </div>
                <div class="icon-item">
                    <i class="fas fa-question-circle"></i>
                    <span>fas fa-question-circle</span>
                </div>
                <div class="icon-item">
                    <i class="fas fa-star"></i>
                    <span>fas fa-star</span>
                </div>
                <div class="icon-item">
                    <i class="fas fa-heart"></i>
                    <span>fas fa-heart</span>
                </div>
                <div class="icon-item">
                    <i class="fas fa-bookmark"></i>
                    <span>fas fa-bookmark</span>
                </div>
                <div class="icon-item">
                    <i class="fas fa-clock"></i>
                    <span>fas fa-clock</span>
                </div>
            </div>
            
            <div class="code-block">
&lt;i class="fas fa-icon-name"&gt;&lt;/i&gt; 图标文本
            </div>
            
            <div class="note">
                <div class="note-title"><i class="fas fa-lightbulb"></i> 提示</div>
                <p>访问 <a href="https://fontawesome.com/icons" class="article-link">Font Awesome 图标库</a> 获取更多可用图标。</p>
            </div>
        </section>
    </div>
<?php include 'foot.php'; ?>